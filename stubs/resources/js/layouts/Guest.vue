<template>
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-6 sm:pt-0 bg-gray-100">
        <div>
            <router-link to="/">
                <BreezeApplicationLogo class="w-20 h-20 fill-current text-gray-500" />
            </router-link>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            <slot />
        </div>
    </div>
<!--    <div class="absolute top-0 w-full flex justify-center">-->
<!--        <div class="bg-green-500 opacity-80 hover:opacity-100 h-12 w-80 rounded px-2 py-3 leading-6 font-medium text-sm text-white">信息框</div>-->
<!--    </div>-->
</template>

<script>
import BreezeApplicationLogo from '@/components/ApplicationLogo.vue'

export default {
    components: {
        BreezeApplicationLogo,
    }
}
</script>
