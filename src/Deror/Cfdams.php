<?php

/**
 * User: Deror
 * Date: 2020/09/03
 * Time: 21:39
 */

namespace Deror\Cfdams;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;

class Cfdams
{
    protected $client = null;
    protected $url = "https://ams.scf.tw";
    protected $sToken = "1231313654646498413161346489";
    protected $error = "";

    public function __construct(array $params = [])
    {
        foreach ($params as $key => $value) {
            $this->$key = $value;
        }
        $this->client = new Client();
    }
    /**
     * Api Post
     */
    public function post($endpoint, array $params = [], array $querys = [])
    {
        $params['sToken'] = isset($params['sToken']) ? $params['sToken'] : $this->sToken;

        try {

            $response = $this->client->request('POST', $this->url . $endpoint, ['form_params' => $params]);

            if ($response->getStatusCode() == 200) {
                $res = $response->getBody()->getContents();
                return json_decode($res, 1);
            }

            $this->error = "http status error: " . $response->getStatusCode();
            return false;
        } catch (ClientException $e) {
            // echo 'error'; return false;
            $this->error = $e->getResponse()->getBody()->getContents();
            return false;
        } catch (\Exception $e) {

            $this->error = $e->getMessage();
            return false;
        }

        $this->error = "????";
        return false;
    }

    /**
     * 取得錯誤
     */
    public function getError()
    {

        return $this->error;
    }


    /**
     * Get Login Url
     */
    public function getLoginUrl()
    {

        return $this->url . '/login?SRV_TOKEN=' . $this->sToken;
    }

    /**
     * Update Token
     */
    public function updateToken()
    {


        return $this->post('/updateToken');
    }

    /**
     * Get Token Expire Info
     */
    public function getExpireToken()
    {

        return $this->post('/expireToken');
    }

    /**
     * 判斷是否需要更新token
     */
    public function isNeedUpdateToken()
    {

        $res = $this->getExpireToken();
        if (
            $res['STATUS'] == 'SUCCESS' &&
            ((strtotime($res['MESSAGE']) - strtotime(date('Y-m-d'))) / 86400) >= 2
        ) {

            return false;
        }
        return true;
    }

    /**
     * Get Department (員工部門)
     */
    public function getDepartment()
    {

        return $this->post('/getdepartment');
    }

    /**
     * Get Employee (員工資料)
     */
    public function getEmployee($uToken)
    {

        return $this->post('/emp', ['uToken' => $uToken]);
    }

    /**
     * Get Employee (員工資料)
     * 帶入 ALL, department id, resign 
     */
    public function getEmployees($endpoint)
    {

        return $this->post('/getemp', ['department' => $endpoint]);
    }

    /**
     * 	取得全部員工
     */
    public function getEmployeesAll()
    {

        return $this->getEmployees('ALL');
    }
}
