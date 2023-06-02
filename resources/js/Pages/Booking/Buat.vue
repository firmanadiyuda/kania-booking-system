<script setup>
import { Head, Link, useForm } from "@inertiajs/vue3";
import { onMounted } from 'vue'
import AppLayout from '@/Layouts/AppLayout.vue';
import Welcome from '@/Components/Welcome.vue';
import PrimaryButton from "@/Components/PrimaryButton.vue";
import TextInput from "@/Components/TextInput.vue";
import SelectInput from "@/Components/SelectInput.vue";
import TextArea from "@/Components/TextArea.vue";
import { useStore } from 'vuex'

const store = useStore()



defineProps({
	canResetPassword: Boolean,
	status: String,
});

const form = useForm({
	nama_pelanggan: "",
	nomor_hp: "",
	alamat: "",
	email: "",
	lokasi_acara: "",
	tanggal_booking: "",
	diskon: "",
	booking_list: store.state.cart,
});

const submit = () => {
	form.transform((data) => ({
		...data
	})).post(route("buatBooking"), {
		// onFinish: () => form.reset("nama"),
	});
};

const removeFromCart = (id) => {
	store.commit('removeFromCart', id)
	console.log(store.state.cart)
};
</script>

<template>
	<AppLayout title="Dashboard">
		<template #header>
			<h2 class="flex font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				<Link :href="route('busanaList')" class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
					width="24" height="24">
					<path
						d="M7.82843 10.9999H20V12.9999H7.82843L13.1924 18.3638L11.7782 19.778L4 11.9999L11.7782 4.22168L13.1924 5.63589L7.82843 10.9999Z"
						class="fill-gray-400"></path>
				</svg></Link>
				Buat Booking Baru
			</h2>
		</template>

		<div class="pt-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
					
					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
						<li v-for="cart in store.state.cart" class="p-2 ">
							<div
								class="flex w-full  bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
								<div class="mr-4">
									<img class="rounded-lg w-44" :src="cart.fotos[0].path" alt="Large avatar">
								</div>
								<div class="pr-2">
									<a href="#">
										<h5 class="py-1 text-md font-bold tracking-wide text-gray-900 dark:text-white">
											{{ (cart.nama).substring(0, 15) }}</h5>
									</a>
									<div class="flex items-center py-1">
										<span
											class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">{{
												cart.tipe }}</span>
										<span
											class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 capitalize">{{
												cart.ukuran }}</span>
										<span
											class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 capitalize">{{
												cart.warna }}</span>

									</div>
									<div class="">
										<button type="button" @click="removeFromCart(cart.id)"
											class="flex focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-1 mr-2 my-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
												height="18" class="fill-gray-300 mr-2">
												<path
													d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z">
												</path>
											</svg>
											Hapus</button>
									</div>
								</div>
							</div>

						</li>

					</ul>


				</div>
			</div>
		</div>


		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg">
					<form @submit.prevent="submit" enctype="multipart/form-data">
						<div class="p-5">

							<div>
								<TextInput id="nama_pelanggan" label="Nama Lengkap" v-model="form.nama_pelanggan"
									v-model:error-message="form.errors.nama_pelanggan" type="text" class="mt-1 block w-full"
									required autocomplete="nama_pelanggan" />
							</div>

							<div class="mt-4">
								<TextInput id="nomor_hp" label="Nomor HP" v-model="form.nomor_hp"
									v-model:error-message="form.errors.nomor_hp" type="number" class="mt-1 block w-full"
									required autocomplete="nomor_hp" />
							</div>

							<div class="mt-4">
								<TextInput id="alamat" label="Alamat" v-model="form.alamat"
									v-model:error-message="form.errors.alamat" type="text" class="mt-1 block w-full"
									required autocomplete="alamat" />
							</div>

							<div class="mt-4">
								<TextInput id="email" label="Email" v-model="form.email"
									v-model:error-message="form.errors.email" type="email" class="mt-1 block w-full"
									required autocomplete="email" />
							</div>

							<div class="mt-4">
								<TextInput id="lokasi_acara" label="Lokasi Acara" v-model="form.lokasi_acara"
									v-model:error-message="form.errors.lokasi_acara" type="text" class="mt-1 block w-full"
									required autocomplete="lokasi_acara" />
							</div>

							<div class="mt-4">
								<TextInput id="tanggal_booking" label="Tanggal Booking" v-model="form.tanggal_booking"
									v-model:error-message="form.errors.tanggal_booking" type="date"
									class="mt-1 block w-full" required autocomplete="tanggal_booking" />
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
								Proses Booking
							</PrimaryButton>
						</div>
					</form>
				</div>
		</div>
	</div>
</AppLayout></template>
