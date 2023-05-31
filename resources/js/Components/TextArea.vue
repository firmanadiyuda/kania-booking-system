<script setup>
import { onMounted, ref } from 'vue';

defineProps({
	id: String,
	label: String,
	modelValue: String,
	errorMessage: String,
});

defineEmits(['update:modelValue', 'update:errorMessage']);

const input = ref(null);

onMounted(() => {
	if (input.value.hasAttribute("autofocus")) {
		input.value.focus();
	}
});

defineExpose({ focus: () => input.value.focus() });
</script>

<template>
	<div class="relative m-0 p-0 border-0">
		<textarea ref="textarea" :id="id" v-bind="$attrs"
            class="block px-2.5 pb-2.5 pt-4 w-full text-sm text-gray-700 tracking-wide bg-transparent rounded-lg border-1 border-gray-300 appearance-none dark:text-white dark:border-gray-600 dark:focus:border-blue-500 focus:outline-none focus:ring-0 focus:border-blue-600 peer"
            :class="{ 'focus:border-red-600 border-red-600 dark:focus:border-red-500 dark:border-red-500': errorMessage }"
            :value="modelValue" @input="$emit('update:modelValue', $event.target.value);
            $emit('update:errorMessage', null);" placeholder=" " />

		<label :for=" id "
			class="absolute text-sm text-gray-900 dark:text-gray-400 duration-300 transform -translate-y-4 scale-90 top-2 z-10 origin-[0] bg-white dark:bg-gray-800 px-2 peer-focus:px-2 peer-focus:text-blue-600 peer-focus:dark:text-blue-500 peer-placeholder-shown:text-gray-500 peer-placeholder-shown:scale-100 peer-placeholder-shown:-translate-y-1/2 peer-placeholder-shown:top-6 peer-focus:top-2 peer-focus:scale-90 peer-focus:-translate-y-4 left-1 tracking-wider font-bold rounded-md"
			:class=" { 'text-red-600 dark:text-red-500 peer-focus:text-red-600 peer-focus:dark:text-red-500 peer-placeholder-shown:text-red-500': errorMessage } ">
			{{ label }}
		</label>
	</div>

	<div v-show=" errorMessage " class="mt-2">
		<p class="text-sm text-red-600">
			{{ errorMessage }}
		</p>
	</div>
</template>
