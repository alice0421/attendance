const mentorLogin = (email: string, password: string): void => {
    // useNuxtApp()はoutside of a plugin, Nuxt hook, Nuxt middleware, or Vue setup functionでしか書けないのでしょうがない。
    const axios: any = useNuxtApp().$axios;

    const data = {
        'email': email,
        'password': password,
    };
    axios.get('/sanctum/csrf-cookie') // CSRF保護の初期化 (axiosは自動でX-XSRF-TOKENを設定してくれる)
        .then((response: any) => {
            // メンターログイン処理
            axios.post('/mentors/login', data)
                .then((response: any) => {
                    console.log('【OK!!!】');
                    console.log(response.data);
                })
                .catch((error: any) => {
                    console.log('【ERROR!!!】');
                    console.log(error.response.data);
                });
        });
}

const mentorInfo = (): void => {
    const axios: any = useNuxtApp().$axios;

    // ログインメンター情報の確認
    axios.get('/mentors')
        .then((response: any) => {
            console.log('【OK!!!】');
            console.log(response.data);
        })
        .catch((error: any) => {
            console.log('【ERROR!!!】');
            console.log(error.response.data);
        });
}

export {
    mentorLogin,
    mentorInfo,
}
