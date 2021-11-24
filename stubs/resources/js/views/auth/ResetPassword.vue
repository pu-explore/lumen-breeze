<template>
    <BreezeGuestLayout>
        <div class="my-2 font-medium text-sm text-green-600 h-5">
            {{ status }}
        </div>
        <form @submit.prevent="submit">
            <div>
                <BreezeLabel for="email" value="Email" />
                <BreezeInput id="email" type="email" class="mt-1 block w-full" v-model="form.email" required readonly autofocus autocomplete="username" />
                <BreezeValidationErrors error="email" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password" value="Password" />
                <BreezeInput id="password" type="password" class="mt-1 block w-full" v-model="form.password" required autocomplete="new-password" />
                <BreezeValidationErrors error="password" />
            </div>

            <div class="mt-4">
                <BreezeLabel for="password_confirmation" value="Confirm Password" />
                <BreezeInput id="password_confirmation" type="password" class="mt-1 block w-full" v-model="form.password_confirmation" required autocomplete="new-password" />
            </div>

            <div class="flex items-center justify-end mt-4">
                <BreezeButton :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                    Reset Password
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
                token: this.$route.query.token,
                email: this.$route.query.email,
                password: '',
                password_confirmation: '',
            }
        }
    },

    methods: {
        submit() {
            axios.post('/reset-password', this.form)
                .then((response) => {
                    this.status = response.data.status;
                    const _this = this;
                    setTimeout(function () {
                        _this.$router.push('/login');
                    }, 1500);
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
