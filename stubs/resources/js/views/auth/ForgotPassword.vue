<template>
    <BreezeGuestLayout>
        <div class="text-sm text-gray-600">
            Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
        </div>
        <div class="my-2 font-medium text-sm text-green-600 h-5">
            {{ status }}
        </div>
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required autofocus autocomplete="username" />
                <BreezeValidationErrors error="email" />
            </div>

            <div class="flex items-center justify-end mt-1">
                <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Email Password Reset Link
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
                email: ''
            }
        }
    },

    methods: {
        submit() {
            this.status = '';
            axios.post('/forgot-password', this.form)
                .then((response) => {
                    this.status = response.data.status;
                })
                .catch((error) => {
                    if (error.response.status === 422) {
                        this.$store.commit('updateErrors', error.response.data);
                    }
                });
        }
    }
}
</script>
