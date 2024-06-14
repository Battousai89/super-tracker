<template>
    <div class="container container-header text-white pt-2">
        <div class="d-flex flex-nowrap justify-content-between align-items-center">
            <router-link class="fs-1 header-logo" to="/">Super Tracker</router-link>
            <div class="d-flex flex-nowrap justify-content-between align-items-center">
                <router-link class="fs-3 custom-link" to="/">Задачи</router-link>
                <router-link class="fs-3 custom-link" to="/projects">Проекты</router-link>
                <router-link class="fs-3 custom-link" to="/statistics">Статистика</router-link>
            </div>
           <svg v-on:click="logout" class="logout-btn" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                 width="35px" fill="white" height="35px" viewBox="0 0 533.333 533.333" style="enable-background:new 0 0 533.333 533.333;"
                 xml:space="preserve">
                <g>
                    <path d="M416.667,333.333v-66.666H250V200h166.667v-66.667l100,100L416.667,333.333z M383.333,300v133.333H216.667v100l-200-100V0
                        h366.667v166.667H350V33.333H83.333L216.667,100v300H350V300H383.333z"/>
                </g>
            </svg>
        </div>
    </div>
</template>

<script>
export default {
    data: () => ({
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        token: localStorage.getItem('token'),
    }),
    methods: {
        logout() {
            axios.get('/api/v1/auth/logout')
                .then(response => {
                    if (response.status === 200) {
                        window.location.href = "/login";
                    }
                });
        },
        checkAuth() {
            axios.get('/api/v1/auth/check')
                .then(response => {
                    if (response.status === 200 && (response.data === false || response.data ===0)) {
                        this.$router.push('/login');
                    }
                }).catch(error => {
                    if (error.response.status === 401) {
                        this.$router.push('/login');
                    }
            });
        }
    },
    mounted() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        this.checkAuth();
    }
}
</script>
