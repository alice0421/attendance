import axios from "axios";

export default defineNuxtPlugin((NuxtApp: any) => {
    const prodURL = ""; // 本番環境
    const devURL = "http://localhost:80"; // 開発環境
    
    const instance = axios.create({
        // "Accept": "application/json"はデフォルトで存在
        baseURL: devURL,
        withCredentials: true, // CORSとクッキーでSPA認証しているため
    });

    return {
        provide: {
            axios: instance,
        },
    }
});
