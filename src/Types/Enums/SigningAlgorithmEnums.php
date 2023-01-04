<?php

namespace DAndreevich\FireblocksSdkLaravel\Types\Enums;

class SigningAlgorithmEnums extends EnumCustom
{
    const MPC_ECDSA_SECP256K1 = "MPC_ECDSA_SECP256K1";
    const MPC_ECDSA_SECP256R1 = "MPC_ECDSA_SECP256R1";
    const MPC_EDDSA_ED25519   = "MPC_EDDSA_ED25519";
}