<template>
    <div class="container h-100">
        <div class="row h-100">
            <div class="card center-block col-md-4 m-auto">
                <div class="card-header text-center">Авторизация</div>
                <form class="card-body align-content-center" @submit.prevent="submitForm">
                    <input type="hidden" name="_token" :value="csrf">
                    <label class="form-label w-100" for="email">
                        Email <br/>
                        <input v-model="formData.email" class="w-100" name="email" type="email" required/>
                        <span class="text-danger" v-if="errors?.email">{{ errors.email[0] }}</span>
                    </label>

                    <label class="form-label w-100" for="password">
                        Пароль <br/>
                        <input v-model="formData.password" class="w-100" name="password" type="password" required/>
                        <span class="text-danger" v-if="errors?.password">{{ errors.password[0] }}</span>
                    </label>

                    <input class="bg-white border-1 p-1 mt-2" type="submit" value="Войти"/>
                    <router-link class="link-dark ms-3" to="/register">Нет аккаунта?</router-link>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        formData: {
            email: '',
            password: '',
        },
        errors: {},
    }),
    methods: {
        submitForm() {
            axios.get('/sanctum/csrf-cookie').then(response => {
                axios.post('/api/v1/auth/login', this.formData, {
                    withCredentials: true,
                    withXSRFToken: true,
                    headers: {
                        'X-CSRF-TOKEN': response.data
                    }
                }).then(response => {
                        if (response.status === 200) {
                            localStorage.setItem('token', response.data)
                            window.location.href = '/';
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data.errors;
                        }
                    });
            });
        },
    },
}
</script>
