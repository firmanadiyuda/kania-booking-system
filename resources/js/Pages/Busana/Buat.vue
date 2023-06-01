<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextArea from "@/Components/TextArea.vue";

defineProps({
    canResetPassword: Boolean,
    status: String,
});

const form = useForm({
    nama: "",
    deskripsi: "",
    tipe: "",
    warna: "",
    ukuran: "",
    video: "",
    harga: "",
    foto: "",
    // foto1: "",
    // foto2: "",
    // foto3: "",
    // foto4: "",
    // foto5: "",
    // foto6: "",
});

const submit = () => {
    form.transform((data) => ({
        ...data
    })).post(route("buatBusana"), {
        // onFinish: () => form.reset("nama"),
    });
};
</script>

<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
                <Link :href="route('indexBusana')" class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path d="M7.82843 10.9999H20V12.9999H7.82843L13.1924 18.3638L11.7782 19.778L4 11.9999L11.7782 4.22168L13.1924 5.63589L7.82843 10.9999Z" class="fill-gray-400"></path></svg></Link>
                Buat Busana Baru
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
                    <form @submit.prevent="submit" enctype="multipart/form-data">
                        <div class="p-5">

                            <div>
                                <TextInput id="nama" label="Nama" v-model="form.nama"
                                    v-model:error-message="form.errors.nama" type="text" class="mt-1 block w-full" required
                                    autocomplete="nama" />
                            </div>

                            <div class="mt-4">
                                <TextArea id="deskripsi" label="Deskripsi" rows="4" v-model="form.deskripsi"
                                    v-model:error-message="form.errors.deskripsi" type="text" class="mt-1 block w-full"
                                    required autocomplete="deskripsi" />
                            </div>

                            <div class="mt-4">
                                <SelectInput id="tipe" label="Tipe" rows="4" v-model="form.tipe"
                                    v-model:error-message="form.errors.tipe" class="mt-1 block w-full" required
                                    autocomplete="tipe">
                                    <template #options>
                                        <option value="" selected disabled> Pilih Tipe Busana </option>
                                        <option value="gaun">Gaun</option>
                                        <option value="kebaya">Kebaya</option>
                                        <option value="Jas">Jas</option>
                                        <option value="basofi">Basofi</option>
                                        <option value="beskap">Beskap</option>
                                    </template>
                                </SelectInput>
                            </div>

                            <div class="mt-4">
                                <TextInput id="warna" label="Warna" v-model="form.warna"
                                    v-model:error-message="form.errors.warna" type="text" class="mt-1 block w-full" required
                                    autocomplete="warna" />
                            </div>

                            <div class="mt-4">
                                <SelectInput id="ukuran" label="Ukuran" rows="4" v-model="form.ukuran"
                                    v-model:error-message="form.errors.ukuran" class="mt-1 block w-full" required
                                    autocomplete="ukuran">
                                    <template #options>
                                        <option value="" selected disabled> Pilih Ukuran Busana </option>
                                        <option value="s">S</option>
                                        <option value="m">M</option>
                                        <option value="l1">L1</option>
                                        <option value="l2">L2</option>
                                        <option value="l3">L3</option>
                                        <option value="l4">L4</option>
                                        <option value="l5">L5</option>
                                        <option value="l6">L6</option>
                                    </template>
                                </SelectInput>
                            </div>

                            <div class="mt-4">
                                <TextInput id="harga" label="Harga" v-model="form.harga"
                                    v-model:error-message="form.errors.harga" type="number" class="mt-1 block w-full"
                                    required autocomplete="harga" />
                            </div>

                            <div class="mt-4">
                                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="foto">Foto
                                </label>
                                <input
                                    class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
                                    id="foto" name="foto" type="file" multiple @input="form.foto = $event.target.files" required>
                            </div>

                        </div>

                        <div class="flex items-center justify-end mt-4 bg-gray-300 dark:bg-gray-700 p-5">
                            <div class="bg-gray-200 rounded-full dark:bg-gray-700 w-1/2 md:w-10/12">
                                <div v-if="form.progress"
                                    class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                    :style="'width: ' + form.progress.percentage + '%'"> {{ form.progress.percentage }}%
                                </div>
                            </div>
                            <PrimaryButton class="ml-4 w-1/2 md:w-2/12 justify-center"
                                :class="{ 'opacity-25': form.processing }" :disabled="form.processing">
                                Buat Busana
                            </PrimaryButton>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </AppLayout></template>
