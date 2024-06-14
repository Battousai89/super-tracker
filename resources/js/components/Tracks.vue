<template>
    <div class="d-block">
        <ul>
            <li v-for="track in tracks">
                <div>
                    <span><b>{{ track.user.name }}</b> | Записано {{ track.created }} | Обновлено {{ track.updated }}</span>
                    <p class="fs-5 fw-bold">{{ track.formated_spent_time }} - {{ track.explanation }}</p>
                </div>
            </li>
        </ul>
    </div>
</template>

<script>
export default {
    data: () => ({
        tracks: {},
        errors: {}
    }),
    methods: {
        getTracks() {
            let path = window.location.pathname;
            axios.get('/api/v1' + path + '/tracks')
                .then(response => {
                    if (response.status === 200) {
                        this.tracks = response.data
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
    },
    mounted() {
        this.getTracks();
    }
}
</script>
