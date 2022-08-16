# Opshell.info

**Opshell/Opshell**
- 🔭 嘗試建立一個前後端分離的網站，前端使用Vue，後端使用php。
- 🌱 並藉由專案完善身為全端工程師應該學會的基礎技術。

## 程式環境：
> - Use Node.js 14.18.0

## 程式碼風格原則：
> - 是基底層(會被繼承的class)檔案開頭大寫。
> - 繼承者，駝峰模式，開頭小寫。

## 架構參考：
### [架構參考](https://www.muzilong.cn/storage/html/2/oomusou.io/laravel/laravel-architecture/index.html)：
### [權職劃分](https://medium.com/mr-efacani-teatime/laravel%E7%AD%86%E8%A8%98-%E6%A1%86%E6%9E%B6%E8%A8%AD%E8%A8%88%E6%A8%A1%E5%BC%8F-bbf58d101478)：
> 1. Controller => 該頁面的資料統整，資料和view的交互
> 2. Service => 該主題(如會員)會用到的任何商務邏輯(function)
> 3. Repository => 藉由操作Model，幫助Service實現各種商務邏輯對應的資料庫操作方法。
> 4. Model => 資料庫存取，使用Eloquent Model (ORM)

