<template>
    <div class="base-input">
        <input
            class="base-input__input"
            :type="type"
            :placeholder="placeholder"
            :disabled="disabled"
            @input="onInput"
            @blur="onBlur"
            @focus="onFocus"
            @keyup.enter="onEnter"
            :class="{ 'has-error': error }"
        />
        <span v-if="error" class="error-message">{{ error }}</span>
    </div>
</template>

<script setup>
import { computed } from 'vue';

const props = defineProps({
    modelValue: [String, Number],
    type: {
        type: String,
        default: 'text',
    },
    label: String,
    placeholder: String,
    disabled: Boolean,
    error: String,
});

const emit = defineEmits(['update:modelValue', 'input', 'blur', 'focus', 'enter']);

const onInput = (event) => {
    emit('update:modelValue', event.target.value);
    emit('input', event);
};

const onBlur = (event) => {
    emit('blur', event);
};

const onFocus = (event) => {
    emit('focus', event);
};

const onEnter = (event) => {
    emit('enter', event);
};
</script>

<style lang="scss" scoped>
.base-input {
    display: flex;
    flex-direction: column;

    &__input {
        border-radius: 8px;
        border: 1px solid #E9ECEF;
        padding: 0 14px;
        font-size: 14px;
        font-weight: 400;
        line-height: 17px;
        color: #76787D;
        height: 46px;
    }
}

.base-input label {
    margin-bottom: 5px;
}

.base-input input::placeholder {
    font-weight: 400;
    font-size: 14px;
}

.base-input .error-message {
    color: red;
    margin-top: 5px;
}

.base-input input.has-error {
    border-color: red;
}
</style>
