<template>
    <div class="container h-100">
        <div class="row h-100">
            <div class="card center-block col-md-4 m-auto">
                <div class="card-header text-center">Регистрация</div>
                <form class="card-body align-content-center" @submit.prevent="submitForm">
                    <input type="hidden" name="_token" :value="csrf">
                    <label class="form-label w-100" for="name">
                        Имя <br/>
                        <input v-model="formData.name" class="w-100" name="name" type="name" required/>
                        <span class="text-danger" v-if="errors?.name">{{ errors.name[0] }}</span>
                    </label>

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

                    <label class="form-label w-100" for="password-confirmation">
                        Подтверждение пароля <br/>
                        <input v-model="formData.password_confirmation" class="w-100" name="password-confirmation" type="password" required/>
                        <span class="text-danger" v-if="errors?.password">{{ errors.password[0] }}</span>
                    </label>

                    <input class="bg-white border-1 p-1 mt-2" type="submit" value="Зарегистрироваться"/>
                    <router-link class="link-dark ms-3" to="/login">Уже есть аккаунт?</router-link>
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
            password_confirmation: ''
        },errors: {},
    }),
    methods: {
        submitForm() {
            axios.post('/api/v1/auth/register', this.formData)
                .then(response => {
                    if (response.status === 200) {
                        window.location.href = "/login";
                    }
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },
    },
}
</script>
