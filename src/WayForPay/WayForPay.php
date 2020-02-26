<?php

namespace Ognistyi\WayForPay;


/**
 * WayForPay
 *
 * Class WayForPay
 * @author Chenakal Serhii
 */
class WayForPay
{
    const ADDRESS_URL_WAY_FOR_PAY = "https://secure.wayforpay.com/pay";

    /** @var  string ������������� ��������. ������ �������� ������������� ��� �� ������� WayForPay */
    protected $merchantAccount;
    /** @var  string SecretKey �������� */
    protected $merchantSecretKey;

    /**
     * @param string $merchantAccount ������������� ��������. ������ �������� ������������� ��� �� ������� WayForPay
     * @param string $merchantSecretKey SecretKey ��������
     */
    public function __construct($merchantAccount, $merchantSecretKey)
    {
        $this->merchantAccount = $merchantAccount;
        $this->merchantSecretKey = $merchantSecretKey;
    }

    /**
     * �������������: ������������� ��������. ������ �������� ������������� ��� �� ������� WayForPay
     * @param string $merchantAccount ������������� ��������. ������ �������� ������������� ��� �� ������� WayForPay
     * @return $this
     */
    public function setMerchantAccount($merchantAccount)
    {
        $this->merchantAccount = $merchantAccount;
        return $this;
    }

    /**
     * ��������: ������������� ��������. ������ �������� ������������� ��� �� ������� WayForPay
     * @return string ������������� ��������. ������ �������� ������������� ��� �� ������� WayForPay
     */
    public function getMerchantAccount()
    {
        return $this->merchantAccount;
    }
}
