// Minimal Hardhat deploy script. Execute via: npx hardhat run deploy.js --network goerli
async function main() {
  const hre = require("hardhat");

  const EnergyAudit = await hre.ethers.getContractFactory("EnergyAudit");
  const contract = await EnergyAudit.deploy();
  await contract.deployed();

  console.log("EnergyAudit deployed to:", contract.address);
}

main().catch((error) => {
  console.error(error);
  process.exitCode = 1;
});
