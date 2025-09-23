namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Servico;
use App\Models\Empresa;

class ContratacaoController extends Controller
{
    public function confirmar(Request $request, $empresa)
    {
        $user = auth()->user();
        $empresaObj = Empresa::findOrFail($empresa);

        // Salva contratação nos serviços do usuário
        Servico::create([
            'user_id' => $user->id,
            'empresa_id' => $empresaObj->id,
            'status' => 'confirmado'
        ]);

        return redirect()->route('dashboard')->with('success', 'Contratação confirmada! Agora aparece em seus serviços.');
    }
}
