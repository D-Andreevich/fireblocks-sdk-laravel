<?php

namespace FireblocksSdkLaravel\Types\Enums;

class SigningAlgorithmEnums extends EnumCustom
{
    const _MPC_ECDSA_SECP256K1 = "MPC_ECDSA_SECP256K1";
    const _MPC_ECDSA_SECP256R1 = "MPC_ECDSA_SECP256R1";
    const _MPC_EDDSA_ED25519   = "MPC_EDDSA_ED25519";
}