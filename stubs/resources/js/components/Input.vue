<template>
    <input class="border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50 rounded-md shadow-sm"
           :class="[readOnly ? 'bg-gray-300' : '']"
           :value="modelValue"
           @input="$emit('update:modelValue', $event.target.value)"
           ref="input">
</template>

<script>
export default {
    props: ['modelValue'],

    emits: ['update:modelValue'],

    data() {
        return {
            readOnly: false
        }
    },

    mounted() {
        this.readOnly = this.$refs.input.readOnly;
    },

    methods: {
        focus() {
            this.$refs.input.focus()
        }
    }
}
</script>
