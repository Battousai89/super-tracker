<template>
    <Header/>
    <div class="container text-white">
        <div class="d-flex justify-content-between">
            <h1>Задачи</h1>
            <button class="edit-btn" v-on:click="showForm(true)">
                <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                     width="25px" fill="white" height="25px" viewBox="0 0 533.333 533.333" style="enable-background:new 0 0 533.333 533.333;"
                     xml:space="preserve">
                    <g>
                        <path d="M516.667,200H333.333V16.667C333.333,7.462,325.871,0,316.667,0h-100C207.462,0,200,7.462,200,16.667V200H16.667
                            C7.462,200,0,207.462,0,216.667v100c0,9.204,7.462,16.666,16.667,16.666H200v183.334c0,9.204,7.462,16.666,16.667,16.666h100
                            c9.204,0,16.667-7.462,16.667-16.666V333.333h183.333c9.204,0,16.667-7.462,16.667-16.666v-100
                            C533.333,207.462,525.871,200,516.667,200z"/>
                    </g>
                </svg>
            </button>
        </div>
        <span class="separator"></span>
        <Tasks v-if="renderTasks"/>
    </div>

    <div v-if="isShow" class="position-fixed top-0 left-0 bottom-0 right-0 vw-100 vh-100 modal-fullscreen bg-opacity-50 bg-dark">
        <div class="center-block h-100 d-flex justify-content-center align-items-center">
            <form class="add-item-form m-auto align-content-center" @submit.prevent="submitForm">
                <input type="hidden" name="_token" :value="csrf">

                <div class="d-flex justify-content-between">
                    <h3>Создать задачу</h3>
                    <button class="close-form-btn" v-on:click="showForm(false)">
                        <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                             width="25px" fill="black" height="25px" viewBox="0 0 612.043 612.043" style="enable-background:new 0 0 612.043 612.043;"
                             xml:space="preserve">
                        <g>
                            <g id="cross">
                                <g>
                                    <path d="M397.503,306.011l195.577-195.577c25.27-25.269,25.27-66.213,0-91.482c-25.269-25.269-66.213-25.269-91.481,0
                                        L306.022,214.551L110.445,18.974c-25.269-25.269-66.213-25.269-91.482,0s-25.269,66.213,0,91.482L214.54,306.033L18.963,501.61
                                        c-25.269,25.269-25.269,66.213,0,91.481c25.269,25.27,66.213,25.27,91.482,0l195.577-195.576l195.577,195.576
                                        c25.269,25.27,66.213,25.27,91.481,0c25.27-25.269,25.27-66.213,0-91.481L397.503,306.011z"/>
                                </g>
                            </g>
                        </g>
                    </svg>
                    </button>
                </div>

                <label class="form-label w-100" for="name">
                    Название <br/>
                    <input v-model="formData.name" class="w-100" name="name" type="text" required/>
                    <span class="text-danger" v-if="errors?.name">{{ errors.name[0] }}</span>
                </label>

                <label class="form-label w-100" for="user_id">
                    Исполнитель <br/>
                    <select v-model="formData.user_id" class="w-100" name="user_id">
                        <option :value="null" selected>---Пусто---</option>
                        <option v-for="user in users" :value="user.id">{{ user.name }}</option>
                    </select>
                    <span class="text-danger" v-if="errors?.user_id">{{ errors.user_id[0] }}</span>
                </label>

                <label class="form-label w-100" for="project_id">
                    Проект <br/>
                    <select v-model="formData.project_id" class="w-100" name="project_id">
                        <option :value="null" selected>---Пусто---</option>
                        <option v-for="project in projects" :value="project.id">{{ project.name }}</option>
                    </select>
                    <span class="text-danger" v-if="errors?.project_id">{{ errors.project_id[0] }}</span>
                </label>

                <label class="form-label w-100" for="description">
                    Описание <br/>
                    <textarea v-model="formData.description" class="w-100" name="description" type="text" required/>
                    <span class="text-danger" v-if="errors?.description">{{ errors.description[0] }}</span>
                </label>

                <label class="form-label w-100" for="time_estimate">
                    Оценка в минутах <br/>
                    <input v-model="formData.time_estimate" class="w-100" name="time_estimate" type="number" min="0"
                           max="999999"/>
                    <span class="text-danger" v-if="errors?.time_estimate">{{ errors.time_estimate[0] }}</span>
                </label>

                <input id="add-btn" class="bg-white border-1 p-1 mt-2" type="submit" value="Отправить"/>
            </form>
        </div>
    </div>
    <Footer/>
</template>

<script setup>
import Header from "../components/Header.vue";
import Footer from "../components/Footer.vue";
import Tasks from "../components/TasksDashboard.vue";
</script>

<script>
export default {
    data: () => ({
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        isShow: false,
        renderTasks: true,
        token: localStorage.getItem('token'),
        formData: {
            name: '',
            description: '',
            project_id: null,
            user_id: null,
            time_estimate: 0,
        },
        users: {},
        projects: {},
        errors: {},
    }),
    methods: {
        submitForm() {
            document.querySelector('#add-btn').disabled = true;
            this.formData.time_estimate = this.formData.time_estimate * 60;
            axios.post('/api/v1/tasks', this.formData)
                .then(response => {
                    if (response.status === 200) {
                        this.showForm(false);
                        this.forceRerender()
                    }
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
            this.formData.time_estimate = this.formData.time_estimate / 60;
            document.querySelector('#add-btn').disabled = false;
        },
        showForm(state = false) {
            if (state) {
                document.querySelector('body').classList.add("overflow-y-hidden");
            } else {
                document.querySelector('body').classList.remove("overflow-y-hidden");
            }
            this.isShow = state;
        },
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
        getUsers() {
            axios.get('/api/v1/users')
                .then(response => {
                    if (response.status === 200) {
                        this.users = response.data
                    }
                })
                .catch(error => {
                    this.errors = error.response.data.errors;
                });
        },
        async forceRerender() {
            this.renderTasks = false;
            await this.$nextTick();
            this.renderTasks = true;
        }
    },
    mounted() {
        this.getProjects();
        this.getUsers();
    },
    components: Header, Footer, Tasks
}
</script>
