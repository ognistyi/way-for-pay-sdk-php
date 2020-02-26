<?php

namespace Ognistyi\WayForPay;


/**
 * ������� ������ (Purchase)
 *
 * Class WayForPay
 * @author Chenakal Serhii
 */
class ResponsePayment extends WayForPay
{
    /** @var  string ���������� ����� ������ � ������� �������� */
    private $orderReference;
    /** @var  string hash_hmac */
    private $merchantSignature;
    /** @var  string ����� ������ */
    private $amount;
    /** @var  string ������ ������ */
    private $currency;
    /** @var  string ��� ����������� - ������������� ������ */
    private $authCode;
    /** @var  string email ����������� */
    private $email;
    /** @var  string ����� �������� ����������� */
    private $phone;
    /** @var  string ���� �������� ������� � psp (UTC) */
    private $createdDate;
    /** @var  string ���� ��������������� ���������� (UTC) */
    private $processingDate;
    /** @var  string ������������� ����� ����� (44****4444) */
    private $cardPan;
    /** @var  string ���� �����: Visa/MasterCard */
    private $cardType;
    /** @var  string ������ ����� */
    private $issuerBankCountry;
    /** @var  string ��� ����� ����� */
    private $issuerBankName;
    /** @var  string ����� ����� ��� ������������ �������� */
    private $recToken;
    /** @var  string ������ ���������� */
    private $transactionStatus;
    /** @var  string ������� ������ */
    private $reason;
    /** @var  string ��� ������ */
    private $reasonCode;
    /** @var  string �������� psp */
    private $fee;
    /** @var  string ��������� �������, ����� ������� ��� ����������� ������. */
    private $paymentSystem;

    public function __construct($merchantAccount, $merchantSecretKey)
    {
        parent::__construct($merchantAccount, $merchantSecretKey);

        if(!empty($_POST)){
            foreach($this as $key => $value){
                if(!empty($_POST[$key])){
                    $this->{$key} = $_POST[$key];
                }
            }
        }
    }

    /**
     * ��������: ������������� ��������
     * @return string ������������� ��������
     */
    public function getMerchantAccount()
    {
        return $this->merchantAccount;
    }

    /**
     * ��������: ���������� ����� ������ � ������� ��������
     * @return string ���������� ����� ������ � ������� ��������
     */
    public function getOrderReference()
    {
        return $this->orderReference;
    }

    /**
     * ��������: hash_hmac
     * @return string hash_hmac
     */
    public function getMerchantSignature()
    {
        return $this->merchantSignature;
    }

    /**
     * ��������: ����� ������
     * @return string ����� ������
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * ��������: ������ ������
     * @return string ������ ������
     */
    public function getCurrency()
    {
        return $this->currency;
    }

    /**
     * ��������: ��� ����������� - ������������� ������
     * @return string ��� ����������� - ������������� ������
     */
    public function getAuthCode()
    {
        return $this->authCode;
    }

    /**
     * ��������: email �����������
     * @return string email �����������
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * ��������: ����� �������� �����������
     * @return string ����� �������� �����������
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * ��������: ���� �������� ������� � psp (UTC)
     * @return string ���� �������� ������� � psp (UTC)
     */
    public function getCreatedDate()
    {
        return $this->createdDate;
    }

    /**
     * ��������: ���� ��������������� ���������� (UTC)
     * @return string ���� ��������������� ���������� (UTC)
     */
    public function getProcessingDate()
    {
        return $this->processingDate;
    }

    /**
     * ��������: ������������� ����� ����� (44****4444)
     * @return string ������������� ����� ����� (44****4444)
     */
    public function getCardPan()
    {
        return $this->cardPan;
    }

    /**
     * ��������: ���� �����: Visa/MasterCard
     * @return string ���� �����: Visa/MasterCard
     */
    public function getCardType()
    {
        return $this->cardType;
    }

    /**
     * ��������: ������ �����
     * @return string ������ �����
     */
    public function getIssuerBankCountry()
    {
        return $this->issuerBankCountry;
    }

    /**
     * ��������: ��� ����� �����
     * @return string ��� ����� �����
     */
    public function getIssuerBankName()
    {
        return $this->issuerBankName;
    }

    /**
     * ��������: ����� ����� ��� ������������ ��������
     * @return string ����� ����� ��� ������������ ��������
     */
    public function getRecToken()
    {
        return $this->recToken;
    }

    /**
     * ��������: ������ ����������
     * @return string ������ ����������
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * ��������: ������� ������
     * @return string ������� ������
     */
    public function getReason()
    {
        return $this->reason;
    }

    /**
     * ��������: ��� ������
     * @return string ��� ������
     */
    public function getReasonCode()
    {
        return $this->reasonCode;
    }

    /**
     * ��������: �������� psp
     * @return string �������� psp
     */
    public function getFee()
    {
        return $this->fee;
    }

    /**
     * ��������: ��������� �������, ����� ������� ��� ����������� ������.
     * @return string ��������� �������, ����� ������� ��� ����������� ������.
     */
    public function getPaymentSystem()
    {
        return $this->paymentSystem;
    }

    /**
     * ��������: ������� �������
     * @return string ������� �������
     */
    protected function generateMerchantSignature()
    {
        $attrForSignature = array(
            'merchantAccount',
            'orderReference',
            'amount',
            'currency',
            'authCode',
            'transactionStatus',
            'reasonCode',
        );

        $values = array();
        foreach ($attrForSignature as $attr) {
            if (empty($this->$attr)) {
                continue;
            }
            $values[] = $this->{$attr};
        }

        $string = implode(';', $values);
        $merchantSignature = hash_hmac('md5', $string, $this->merchantSecretKey);
        return $merchantSignature;
    }

    protected function getStatusesOnSuccess()
    {
        return array(
            'InProcessing',
            'Approved',
        );
    }

    /**
     * ��������� ������. ���� true ������� ������ ������� ��� ��� ������
     * @return bool
     */
    public function validation()
    {
//        if(!$response = $this->generateMerchantSignature()){
//            return false;
//        }
//        return $this->merchantSignature == $response;

        return in_array($this->getTransactionStatus(), $this->getStatusesOnSuccess());
    }
}