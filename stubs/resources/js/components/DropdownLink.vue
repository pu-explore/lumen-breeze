<template>
    <router-link :to="href" class="block w-full px-4 py-2 text-left text-sm leading-5 text-gray-700 hover:bg-gray-100 focus:outline-none focus:bg-gray-100 transition duration-150 ease-in-out">
        <slot />
    </router-link>
</template>

<script>
export default {
    components: {},
    props: ['href', 'active'],
}
</script>
