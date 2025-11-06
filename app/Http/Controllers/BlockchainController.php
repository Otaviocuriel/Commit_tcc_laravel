<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BlockchainTransaction;
use Illuminate\Support\Facades\Auth;

class BlockchainController extends Controller
{
    // Retorna ABI + contract address (aguarda que você defina BLOCKCHAIN_CONTRACT_ADDRESS no .env)
    public function contractInfo()
    {
        // Tenta carregar ABI em public/abi/EnergyAudit.json, se não existe, usa ABI embutido
        $abiPath = public_path('abi/EnergyAudit.json');
        if (file_exists($abiPath)) {
            $abi = json_decode(file_get_contents($abiPath), true);
        } else {
            $abi = [
                [
                    "anonymous" => false,
                    "inputs" => [
                        ["indexed"=>false,"internalType"=>"uint256","name"=>"ofertaId","type"=>"uint256"],
                        ["indexed"=>false,"internalType"=>"address","name"=>"buyer","type"=>"address"],
                        ["indexed"=>false,"internalType"=>"string","name"=>"empresa","type"=>"string"],
                        ["indexed"=>false,"internalType"=>"uint256","name"=>"price","type"=>"uint256"],
                        ["indexed"=>false,"internalType"=>"uint256","name"=>"timestamp","type"=>"uint256"]
                    ],
                    "name" => "SaleRecorded",
                    "type" => "event"
                ],
                [
                    "inputs" => [
                        ["internalType"=>"uint256","name"=>"ofertaId","type"=>"uint256"],
                        ["internalType"=>"string","name"=>"empresa","type"=>"string"],
                        ["internalType"=>"uint256","name"=>"price","type"=>"uint256"]
                    ],
                    "name" => "recordSale",
                    "outputs" => [],
                    "stateMutability" => "nonpayable",
                    "type" => "function"
                ]
            ];
        }

        $address = env('BLOCKCHAIN_CONTRACT_ADDRESS', '');

        return response()->json([
            'address' => $address,
            'abi' => $abi,
            'network' => env('BLOCKCHAIN_NETWORK', 'goerli')
        ]);
    }

    // Salva registro local após confirmação de tx no frontend
    public function record(Request $request)
    {
        $data = $request->validate([
            'tx_hash' => 'required|string',
            'oferta_id' => 'nullable|integer',
            'empresa' => 'nullable|string',
            'price' => 'nullable|integer',
            'chain' => 'nullable|string',
            'status' => 'nullable|string',
        ]);

        $tx = BlockchainTransaction::create([
            'user_id' => Auth::id(),
            'oferta_id' => $data['oferta_id'] ?? null,
            'empresa' => $data['empresa'] ?? null,
            'price' => $data['price'] ?? null,
            'tx_hash' => $data['tx_hash'],
            'chain' => $data['chain'] ?? null,
            'status' => $data['status'] ?? 'confirmed',
        ]);

        return response()->json(['ok' => true, 'id' => $tx->id]);
    }

    // Retorna últimas transações (público) — parâmetro ?limit=
    public function transactions(\Illuminate\Http\Request $request)
    {
        $limit = (int) $request->query('limit', 50);
        $limit = $limit > 0 && $limit <= 200 ? $limit : 50;
        $txs = \App\Models\BlockchainTransaction::orderByDesc('created_at')
            ->limit($limit)
            ->get(['id','user_id','oferta_id','empresa','price','tx_hash','chain','status','created_at']);
        return response()->json($txs);
    }
}
