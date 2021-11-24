<template>
    <div class="text-sm text-red-600 h-5">{{ this.$store.state.errors[error] ?? '' }}</div>
</template>

<script>
export default {
    props: ['error']
}
</script>
