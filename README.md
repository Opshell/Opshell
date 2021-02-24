### Hi there 👋

<!--
**Opshell/Opshell** is a ✨ _special_ ✨ repository because its `README.md` (this file) appears on your GitHub profile.

Here are some ideas to get you started:

- 🔭 I’m currently working on ...
- 🌱 I’m currently learning ...
- 👯 I’m looking to collaborate on ...
- 🤔 I’m looking for help with ...
- 💬 Ask me about ...
- 📫 How to reach me: ...
- 😄 Pronouns: ...
- ⚡ Fun fact: ...
-->


是老爸的(會被繼承的class)  檔案開頭  大寫
其他  走駝峰模式 開頭小寫

架構參考：https://www.muzilong.cn/storage/html/2/oomusou.io/laravel/laravel-architecture/index.html
權力劃分：https://medium.com/mr-efacani-teatime/laravel%E7%AD%86%E8%A8%98-%E6%A1%86%E6%9E%B6%E8%A8%AD%E8%A8%88%E6%A8%A1%E5%BC%8F-bbf58d101478

Controller => 該頁面的資料統整，資料和view的交互
Service => 該主題(如會員)會用到的任何商務邏輯(function)

Repository => 藉由操作Model，幫助Service實現各種商務邏輯對應的資料庫操作方法。
Model => 資料庫存取，使用Eloquent Model (ORM) 

