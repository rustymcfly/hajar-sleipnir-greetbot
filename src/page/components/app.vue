<template>
    <div id="app-body">
        <header>
            <nav class="navbar navbar-dark bg-dark">
                <div class="container">
                    <router-link class="navbar-brand" to="/">Hajar Sleipnir</router-link>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"/>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav" ref="navbar">
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <router-link class="nav-link active" aria-current="page" to="/">Home</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/about">About</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" :class="{disabled: !$root.user.auth}" to="/knowledgebase">Knowledgebase</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link class="nav-link" to="/commands">Commands</router-link>
                            </li>
                            <li class="nav-item">
                                <router-link v-if="$root.user.auth" class="nav-link " to="/logout" tabindex="-1" aria-disabled="true">Logout</router-link>
                                <router-link v-if="!$root.user.auth" class="nav-link " to="/login" tabindex="-1" aria-disabled="true">Login</router-link>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </header>
        <section class="bg-black">
            <router-view/>
        </section>
        <footer class="bg-dark text-light py-5">
            <div class="container">
                <div class="row">
                    <div class="col-3 py-3 border-end border-light">
                        <b>States</b><br/>
                        Discord Bot <span class="badge rounded" :class="state.state ? 'bg-success' : 'bg-danger'">&nbsp;</span>
                    </div>
                    <div class="col-3 py-3 border-end border-light">
                   </div>
                    <div class="col-3 py-3 border-end border-light">
                           </div>
                    <div class="col-3 py-3">
                    </div>
                </div>
            </div>
        </footer>
    </div>
</template>

<script>

    import {Collapse} from "bootstrap";

    export default {
        name: "app",
        data() {
            return {
                state: 0
            }
        },
        async created() {
            this.state = await (await fetch(window.location.protocol + '//' + window.location.hostname + ':5000/state')).json()
        },
        mounted() {

            const collapse = new Collapse(this.$refs.navbar, {
                toggle: false
            })

            this.$router.beforeEach(() => {
                collapse.hide()
            })
        }
    }
</script>

<style scoped>

</style>
