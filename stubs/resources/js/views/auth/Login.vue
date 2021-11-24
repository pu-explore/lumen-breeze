<template>
    <BreezeGuestLayout>
        <div class="my-2 font-medium text-sm text-red-600 h-5">
            {{ status }}
        </div>
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                <BreezeValidationErrors error="email" />
            </div>

            <div class="mt-1">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="current-password" />
                <BreezeValidationErrors error="password" />
            </div>

            <div class="flex items-center justify-between mt-1">
                <router-link to="/forgot-password" class="underline text-sm text-gray-600 hover:text-gray-900">
                    Forgot your password?
                </router-link>

                <BreezeButton class="ml-4" :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Log in
                </BreezeButton>
            </div>
        </form>
    </BreezeGuestLayout>
</template>

<script>
import BreezeButton from '@/components/Button.vue'
import BreezeCheckbox from '@/components/Checkbox.vue'
import BreezeGuestLayout from '@/layouts/Guest.vue'
import BreezeInput from '@/components/Input.vue'
import BreezeLabel from '@/components/Label.vue'
import BreezeValidationErrors from '@/components/ValidationErrors.vue'

export default {
    components: {
        BreezeGuestLayout,
        BreezeButton,
        BreezeCheckbox,
        BreezeInput,
        BreezeLabel,
        BreezeValidationErrors,
    },

    data() {
        return {
            status: '',
            form: {
                email: '',
                password: '',
            }
        }
    },
    methods: {
        submit() {
            this.status = '';
            this.$store.commit('clearErrors');
            axios.post('/login', this.form)
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
