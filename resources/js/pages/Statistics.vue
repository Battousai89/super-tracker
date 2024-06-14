<template>
    <Header/>
    <div class="container text-white">
        <h1>Статистика по проектам</h1>
        <ul>
            <li v-for="(project, key) in statistics">
                <span class="separator"></span>

                <span class="fs-5 fw-bold">[{{ key }}] </span>
                <a class="custom-link" :href="'/projects/' + key"> {{ project.name }}</a>
                <p>Затрачено {{ project.formated_spent_time }}</p>

                <div class="d-block">
                    <ul>
                        <li v-for="(task, key) in project.tasks">
                            <span class="fs-5 fw-bold">[{{ key }}] </span>
                            <a class="custom-link" :href="'/tasks/' + key"> {{ task.name }}</a>
                            <p>Затрачено {{ task.formated_spent_time }}</p>
                        </li>
                    </ul>
                </div>
            </li>
        </ul>
    </div>
    <Footer/>
</template>

<script setup>
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";
</script>

<script>
export default {
    data: () => ({
        statistics: {},
        errors: {}
    }),
    methods: {
        getStatistics() {
            axios.get('/api/v1/statistics')
                .then(response => {
                if (response.status === 200) {
                    this.statistics = response.data
                }
            })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
    },
    mounted() {
        this.getStatistics();
    },
    components: Header, Footer,
}
</script>
