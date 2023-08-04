<script setup lang="ts">
import { ref } from 'vue';
import { mentorLogin, mentorInfo } from '../../public/typescript/mentorAuth';

const email: Ref<string> = ref('');
const password: Ref<string> = ref('');
</script>

<template>
    <NavHeader />

    <p>This is Mentor Login Page.</p>

    <div>
        <label for="email">メール</label>
        <input id="email" type="email" v-model="email" />

        <label for="password">パスワード</label>
        <input id="password" type="password" v-model="password" />

        <div>
            <button type="button" @click="mentorLogin(email, password)">ログイン処理ボタン</button>
            <button type="button" @click="mentorInfo()">ログイン確認ボタン</button>
        </div>
    </div>
</template>
