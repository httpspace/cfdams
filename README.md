
CFD公司會員api工具
=======================

CFD公司會員api工具，需配合維x的系統服用。
預計未來更新自動token排程等需求。




## 安裝方式
```bash
$ composer require deror/cfdams
```

## 或
```bash
$ php composer.phar require deror/cfdams
```

## 初始化設定方式
```php

use Deror\Cfdams;

$api = new Cfdams([
    'sToken' => "{你取得的網站TOKEN}",# '必填'
    'url'    => "https://ams.domain.tw" # '選填'
]);
```


## 取得登入網址
```php
$api->getLoginUrl();
```

## 更新token，
1.注意回傳token請重新記錄起來不見了就麻煩惹。
2.到期日仍有三天以上，將無法成功更新。
```php
$api->updateToken();
```

## 查看token到期的時間資訊
```php
$api->getExpireTokenInfo();
```

## 是某需要更新token(預設2天，可於參數帶數字)
```php
$days = 2;
$api->isNeedUpdateToken($days);
```
## 取得部門資訊
```php
$api->getDepartment();
```

## 取得員工資料
```php
$api->getEmployeesAll();
```

## 取得離職員工資料
```php
$api->getEmployeesResign();
```

## 取得老闆資料
```php
$api->getBoss();
```

## 取得IT部門
```php
$api->getEmployeesIT();
```

## 取得企劃部門
```php
$api->getEmployeesPlanning();
```

## 取得人事部門
```php
$api->getEmployeesPersonnel();
```
