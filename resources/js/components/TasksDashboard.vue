<template>
    <ul>
        <li v-for="task in tasks">
            <span class="fs-5 fw-bold">[{{ task.id }}]</span> <a class="custom-link" :href="'/tasks/' + task.id">{{ task.name }}</a>
        </li>
    </ul>
</template>

<script>
export default {
    data: () => ({
        tasks: {},
        errors: {},
    }),
    methods: {
        getTasks() {
            axios.get('/api/v1/tasks')
                .then(response => {
                    if (response.status === 200) {
                        this.tasks = response.data
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
    },
    mounted() {
        this.getTasks();
    }
}
</script>
