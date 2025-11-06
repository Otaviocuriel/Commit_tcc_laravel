// SPDX-License-Identifier: MIT
pragma solidity ^0.8.17;

/// @title EnergyAudit — registro imutável de vendas/contratações (evento)
/// @notice Contrato mínimo: emite evento ao registrar uma venda (oferta)
contract EnergyAudit {
    event SaleRecorded(
        uint256 indexed ofertaId,
        address indexed buyer,
        string empresa,
        uint256 price,
        uint256 timestamp
    );

    /// @notice Registra uma venda/contratação na chain emitindo um evento
    /// @param ofertaId Identificador da oferta (pode ser 0 se não houver)
    /// @param empresa Nome/identificador da empresa (string)
    /// @param price Preço em centavos (integer)
    function recordSale(
        uint256 ofertaId,
        string calldata empresa,
        uint256 price
    ) external {
        emit SaleRecorded(ofertaId, msg.sender, empresa, price, block.timestamp);
    }
}
