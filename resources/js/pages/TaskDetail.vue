<template>
    <Header/>
    <div class="container text-white">
        <div class="d-flex justify-content-between">
            <h1>Задача #{{ $route.params.id }}</h1>
            <button v-if="!editState" class="edit-btn" v-on:click="changeState(true)">
                <svg fill="white" version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="-3px" y="-3px" width="30px" height="30px" viewBox="0 0 485.219 485.22" style="enable-background:new 0 0 485.219 485.22;" xml:space="preserve"><g><path d="M467.476,146.438l-21.445,21.455L317.35,39.23l21.445-21.457c23.689-23.692,62.104-23.692,85.795,0l42.886,42.897
                    C491.133,84.349,491.133,122.748,467.476,146.438z M167.233,403.748c-5.922,5.922-5.922,15.513,0,21.436
                    c5.925,5.955,15.521,5.955,21.443,0L424.59,189.335l-21.469-21.457L167.233,403.748z M60,296.54c-5.925,5.927-5.925,15.514,0,21.44
                    c5.922,5.923,15.518,5.923,21.443,0L317.35,82.113L295.914,60.67L60,296.54z M338.767,103.54L102.881,339.421
                    c-11.845,11.822-11.815,31.041,0,42.886c11.85,11.846,31.038,11.901,42.914-0.032l235.886-235.837L338.767,103.54z
                     M145.734,446.572c-7.253-7.262-10.749-16.465-12.05-25.948c-3.083,0.476-6.188,0.919-9.36,0.919
                    c-16.202,0-31.419-6.333-42.881-17.795c-11.462-11.491-17.77-26.687-17.77-42.887c0-2.954,0.443-5.833,0.859-8.703
                    c-9.803-1.335-18.864-5.629-25.972-12.737c-0.682-0.677-0.917-1.596-1.538-2.338L0,485.216l147.748-36.986
                    C147.097,447.637,146.36,447.193,145.734,446.572z"/></g></svg>
            </button>
            <div v-else class="d-flex justify-content-center align-items-center">
                <button class="edit-btn" v-on:click="saveChanges($route.params.id)">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="25px" fill="white" height="25px" viewBox="0 0 611.99 611.99" style="enable-background:new 0 0 611.99 611.99;"
                         xml:space="preserve">
                            <g>
                                <g id="_x39__34_">
                                    <g>
                                        <path d="M589.105,80.63c-30.513-31.125-79.965-31.125-110.478,0L202.422,362.344l-69.061-70.438
                                            c-30.513-31.125-79.965-31.125-110.478,0c-30.513,31.125-30.513,81.572,0,112.678l124.29,126.776
                                            c30.513,31.125,79.965,31.125,110.478,0l331.453-338.033C619.619,162.202,619.619,111.755,589.105,80.63z"/>
                                    </g>
                                </g>
                            </g>
                        </svg>
                </button>
                <button class="edit-btn" v-on:click="changeState()">
                    <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                         width="25px" fill="white" height="25px" viewBox="0 0 612.043 612.043" style="enable-background:new 0 0 612.043 612.043;"
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
        </div>

        <span class="separator"></span>

        <div class="d-block mt-5 mb-5">
            <span class="text-danger" v-if="errors?.name && editState">{{ errors.name[0] }}</span>
            <input v-if="editState" v-model="formData.name" name="name" type="text" class="h3-input mb-5"/>
            <h3 v-else class="mb-5">{{ task.name }}</h3>

            <span class="text-danger" v-if="errors?.description && editState">{{ errors.description[0] }}</span>
            <textarea v-if="editState" v-model="formData.description" name="description" type="text"
                      class="h3-input mb-5"/>
            <h4 v-else class="mb-5">{{ task.description }}</h4>
        </div>

        <div class="d-block">
            <p>Проект: {{ task.project.name }}</p>
            <p>Исполнитель: {{ task.executor_name }}</p>
            <p>Дата создания: {{ task.created }}</p>
            <p>Последнее изменение: {{ task.updated }}</p>
            <p>Оценка: {{ task.formated_time_estimate }}</p>
            <p :class="{'text-danger':task.is_expired}">Затрачено: {{ task.formated_spent_time }}</p>
        </div>

        <span class="separator"></span>

        <h2 class="row">Затраченное время</h2>
        <Tracks v-if="renderTracks"/>

        <button class="add-track-btn" v-on:click="showForm(true)">
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

    <div v-if="isShow" class="position-fixed top-0 left-0 bottom-0 right-0 vw-100 vh-100 modal-fullscreen bg-opacity-50 bg-dark">
        <div class="center-block h-100 d-flex justify-content-center align-items-center">
            <form class="add-item-form m-auto align-content-center" @submit.prevent="submitForm">
                <input type="hidden" name="_token" :value="csrf">

                <div class="d-flex justify-content-between">
                    <h3>Добавить время</h3>
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

                <label class="form-label w-100" for="date">
                    Дата <br/>
                    <input v-model="trackData.date" class="w-100" name="date" type="date" required/>
                    <span class="text-danger" v-if="errors?.date">{{ errors.date[0] }}</span>
                </label>

                <label class="form-label w-100" for="spent_time">
                    Затрачено в минутах <br/>
                    <input v-model="trackData.spent_time" class="w-100" name="spent_time" type="number" min="0" max="999999"/>
                    <span class="text-danger" v-if="errors?.spent_time">{{ errors.spent_time[0] }}</span>
                </label>

                <label class="form-label w-100" for="explanation">
                    Комментарий <br/>
                    <textarea v-model="trackData.explanation" class="w-100" name="explanation" type="text"/>
                    <span class="text-danger" v-if="errors?.explanation">{{ errors.explanation[0] }}</span>
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
import Tracks from "../components/Tracks.vue";
</script>

<script>
export default {
    data: () => ({
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        token: localStorage.getItem('token'),
        formData: {
            name: '',
            description: '',
        },
        trackData: {
            task_id: null,
            explanation: '',
            date: new Date(),
            spent_time: 0
        },
        editState: false,
        renderTracks: true,
        task: {},
        isShow: false,
        tracks: {},
        errors: {}
    }),
    methods: {
        getTask() {
            let path = window.location.pathname;
            axios.get('/api/v1' + path)
                .then(response => {
                    if (response.status === 200) {
                        this.task = response.data
                    }
                })
                .catch(error => {
                    if (error.response.status === 401) {
                        this.$router.push('/login');
                    }
                    this.errors = error.response.data.errors;
                });
        },
        changeState(editState = false) {
            this.formData.name = this.task.name;
            this.formData.description = this.task.description;
            this.formData.project_id = this.task.project_id;
            this.formData.user_id = this.task.user_id;
            this.formData.time_estimate = this.task.time_estimate;
            this.editState = editState;
        },
        saveChanges(taskId) {
            axios.put('/api/v1/tasks/' + taskId, this.formData)
                .then(response => {
                    if (response.status === 200) {
                        this.task.name = this.formData.name;
                        this.task.description = this.formData.description;
                        this.errors = {};
                        this.changeState();
                    }
                })
                .catch(error => {
                    if (error.response.status === 422) {
                        this.errors = error.response.data.errors;
                    }
                });
        },
        submitForm() {
            document.querySelector('#add-btn').disabled = true;
            this.trackData.task_id = this.task.id;
            this.trackData.spent_time = this.trackData.spent_time * 60;
            axios.post('/api/v1/tracks', this.trackData)
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
            this.trackData.spent_time = this.trackData.spent_time / 60
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
        async forceRerender() {
            this.renderTracks = false;
            await this.$nextTick();
            this.renderTracks = true;
        }
    },
    mounted() {
        window.axios.defaults.headers.common['Authorization'] = `Bearer ${this.token}`;
        this.getTask();
    },
    components: Header, Footer, Tracks,
}
</script>
