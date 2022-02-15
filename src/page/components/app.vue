<template>
    <div>{{state}}</div>
</template>

<script>
    export default {
        name: "app",
        data() {
            return {
                state: 0
            }
        },
        async created() {
            this.state = await (await fetch('/state')).json()
        },
    }
</script>

<style scoped>

</style>
