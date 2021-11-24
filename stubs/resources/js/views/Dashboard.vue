<template>
    <BreezeAuthenticatedLayout>
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Dashboard
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        You're logged in!
                    </div>
                </div>
            </div>
        </div>
    </BreezeAuthenticatedLayout>
</template>

<script>
import BreezeAuthenticatedLayout from '@/Layouts/Authenticated.vue'

export default {
    components: {
        BreezeAuthenticatedLayout,
    },
    created() {
        this.getData();
    },
    methods: {
        getData() {
            const config = {
                headers: {'Authorization': 'Bearer ' + this.$store.state.authToken},
            }
            axios.get('/dashboard', config)
                .then((response) => {
                    this.$store.commit('updateAuthName', response.headers['auth-name']);
                    this.$store.commit('updateAuthEmail', response.headers['auth-email']);
                })
                .catch((error) => {
                    if (error.response.status === 401) {
                        this.$store.commit('clearAuth');
                        this.$router.push('/login');
                    }
                });
        }
    }
}
</script>
