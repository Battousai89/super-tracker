<template>
    <ul>
        <li v-for="project in projects">
            <span class="fs-5 fw-bold">[{{ project.id }}]</span> <a class="custom-link" :href="'/projects/' + project.id">{{ project.name }}</a>
        </li>
    </ul>
</template>

<script>
export default {
    data: () => ({
        projects: {},
        errors: {}
    }),
    methods: {
        getProjects() {
            axios.get('/api/v1/projects')
                .then(response => {
                    if (response.status === 200) {
                        this.projects = response.data
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
    },
    mounted() {
        this.getProjects();
    }
}
</script>
