<template>
    <v-chip :color="statusColor">
        {{ statusName }}
    </v-chip>
</template>

<script>
    export default {
        name: "OrderStatus",

        props: {
            status: {
                type: Number,
                required: true,
            },
        },

        computed: {
            statusName () {
                switch (this.status) {
                    case 0: return 'новый';
                    case 10: return 'подтвержден';
                    case 20: return 'завершен';
                    default: return 'ERROR'
                }
            },

            statusColor () {
                switch (this.status) {
                    case 0: return 'blue';
                    case 10: return 'orange';
                    case 20: return 'green';
                    default: return 'red'
                }
            },
        }
    }
</script>

<style scoped>

</style>
