// 原本寫法
// declare namespace Opshell {
//     export interface iList {
//         id: number;
//         title: string;
//         [key: string]: any;
//     }
// }

// export = Opshell;
// export as namespace Opshell;

//GPT改過的
// 在您的 opshell.d.ts 文件中，您將命名空間導出為模組（使用 "export = Opsehll"）
// 以及為全局（使用 "export as namespace Opsehll"）。
// 這將導致 TypeScript 編譯器無法確定您的導出是屬於哪個範疇的，因此會報錯。

// 如果您打算將命名空間作為全局範圍的接口使用，則可以使用以下方式將其導出：
namespace Opshell {
    export interface iList {
        id: number;
        title: string;
        [key: string]: any;
    }
}

declare global {
    interface Window {
        Opshell: typeof Opshell;
    }
}

window.Opshell = Opshell;
// 這樣做會將 Opsehll 導出到全局範圍中，並將其添加到 Window 對象上，使其可以在任何地方使用。

// 增加 CKEditor5 的型別
// declare module '@ckeditor/ckeditor5-vue';
// declare module 'ckeditor__ckeditor5-build-classic';

// 增加 Jodit 的型別
declare module 'jodit-vue3';
