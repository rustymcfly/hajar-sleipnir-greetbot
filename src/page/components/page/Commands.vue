<template>
    <div class="container page">
        <h1>Hermodur Commands</h1>
        <ul>
            <li>
                !ping
                Beschränkt auf <b>Jeder</b>
            </li>
            <li>
                !termine
                Beschränkt auf <b>Jeder</b>
            </li>
            <li>
                !detail [event-id]
                Beschränkt auf <b>Jeder</b>
            </li>
            <li>
                !knowledge [typ] ...[tags]
                <br>
                Beschränkt auf <b>Anwärter und darüber</b>
            </li>
            <li>
                !knowledge-add [typ] [...{Feld: Wert}]
                <br>
                Beschränkt auf <b>Mitglied und darüber</b>
            </li>
            <li>
                !knowledge-edit [typ] [id] [...{Feld: Wert}]
                <br>
                Beschränkt auf <b>Mitglied und darüber</b>
            </li>
            <li>
                !knowledge-remove [typ] [id]
                <br>
                Beschränkt auf <b>Vorstand und darüber</b>
            </li>
        </ul>
    </div>
</template>

<script>
    export default {
        name: "Commands"
    }
</script>

<style scoped>

</style>
