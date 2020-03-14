<template>
    <v-app>
        <v-navigation-drawer v-model="drawer" app>
            <v-list dense>
                <v-list-item v-for="link in links" :to="link.route" :key="link.title">
                    <v-list-item-action>
                        <v-icon>{{ link.icon }}</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>{{ link.title }}</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app dark>
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-toolbar-title>Application</v-toolbar-title>
        </v-app-bar>

        <v-content>

            <router-view />

        </v-content>

        <v-footer app dark>
            <span class="white--text">&copy; 2019</span>
        </v-footer>
    </v-app>
</template>

<script>
    export default {
        name: "AppBaseLayout",

        data: () => ({
            drawer: null,

            links: [
                { title: 'Погода', icon: 'fas fa-cloud-sun', route: { name: 'weather' } },
            ]
        }),
    }
</script>

<style scoped>

</style>
