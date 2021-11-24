<template>
    <BreezeGuestLayout>
        <div class="my-2 font-medium text-sm text-red-600 h-5">
            {{ status }}
        </div>
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="name" value="Name" />
                <BreezeInput id="name" type="text" class="mt-1 block w-full" v-model="form.name" required autofocus autocomplete="name" />
                <BreezeValidationErrors error="name" />
            </div>

            <div class="mt-1">
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autocomplete="username" />
                <BreezeValidationErrors error="email" />
            </div>

            <div class="mt-1">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <BreezeValidationErrors error="password" />
            </div>

            <div class="mt-1">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-between mt-4">
                <router-link to="/login" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Already registered?
                </router-link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Register
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>

<script>
import BreezeGuestLayout from '@/layouts/Guest.vue';
import BreezeButton from '@/components/Button.vue';
import BreezeInput from '@/components/Input.vue';
import BreezeLabel from '@/components/Label.vue';
import BreezeValidationErrors from '@/components/ValidationErrors.vue';

export default {
    components: {
        BreezeGuestLayout,
        BreezeButton,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },

    data() {
        return {
            status: '',
            form: {
                name: '',
                email: '',
                password: '',
                password_confirmation: '',
            }
        }
    },

    methods: {
        submit() {
            this.status = '';
            axios.post('/register', this.form)
                .then((response) => {
                    this.$store.commit('updateAuthToken', response.headers.authorization);
                    this.$router.push('/dashboard');
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.$store.commit('updateErrors', error.response.data);
                    }
                    if (error.response.status === 403) {
                        this.status = error.response.data.message;
                    }
                });
        }
    }
}
</script>
