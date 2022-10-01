/** vue-file-import.d.ts 文件
 * 建立此文件用来解決ts警報： 類型 '{}' 上不存在属性 '屬性' 的问题
 */
declare module"*.vue" {
  import Vue from"vue";
  export default Vue;
}