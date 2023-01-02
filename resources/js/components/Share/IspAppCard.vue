<template>
    <div>
        <v-card
            rounded="lg"
            class="overflow-hidden blur shadow-blur"
            elevation-12
            color="white"
        >
            <v-card-title class="text-center text-h6">
                {{ headText }}
            </v-card-title>
            <v-card-text>
                <div v-if="apps.length != 0">
                    <v-table fixed-header>
                        <thead>
                            <tr>
                                <th class="text-left">Název</th>
                                <th class="text-left">Popis</th>
                                <th class="text-right"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr
                                v-for="app in apps"
                                :key="app.id"
                                v-show="app.category == filterString"
                            >
                                <td>{{ app.name }}</td>
                                <td>{{ app.description }}</td>
                                <td>
                                    <a
                                        style="text-decoration: none"
                                        target="_blank"
                                        :href="app.path"
                                    >
                                        <v-icon color="green"
                                            >mdi-download</v-icon
                                        >
                                    </a>

                                    <v-icon
                                        color="red"
                                        class="mx-auto"
                                        @click="deleteItem(app.id)"
                                        >mdi-delete</v-icon
                                    >
                                </td>
                            </tr>
                        </tbody>
                    </v-table>
                </div>
                <div v-else>
                    <v-alert
                        type="info"
                        title="Neexistuje obsah"
                        text="Není nahrán žádný obsah"
                        rounded="lg"
                        class="overflow-hidden info-shadow-blur"
                    >
                    </v-alert>
                </div>
            </v-card-text>
        </v-card>
    </div>
</template>
<script>
export default {
    props: {
        apps: Array,
        filterString: String,
        headText: String,
    },

    data() {
        return {};
    },

    methods: {
        deleteItem(itemId) {
            axios.delete("admin/apps/" + itemId).then((response) => {
                this.$emit("showNotification", "test", "color", "true");
            });
        },
    },
};
</script>
