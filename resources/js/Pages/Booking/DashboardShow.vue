<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import { useStore } from 'vuex'
import Modal from '@/Components/Modal.vue';
import TextInput from "@/Components/TextInput.vue";
import TextArea from "@/Components/TextArea.vue";

const store = useStore()
// const props = defineProps(['booking']);

const emit = defineEmits(['close']);

const props = defineProps({
	show: {
		type: Boolean,
		default: false,
	},
	selectedKuitansi: {
		type: Array,
		default: [],
	},
	maxWidth: {
		type: String,
		default: '2xl',
	},
	closeable: {
		type: Boolean,
		default: true,
	},
	booking: {
		type: Array,
		default: [],
	},
});

const close = () => {
	emit('close');
};

const form = useForm({
	id: props.selectedKuitansi.id,
});

const ubahStatusKuitansi = () => {
	form.transform((data) => ({
		...data
	})).post(route("ubahStatusKuitansi"), {
		onFinish: () => {
			show = false;
		}
	});
};



// const addToCart = (payload) => {
// 	store.commit('addToCart', payload)
// 	console.log(store.state.cart)
// };

// const removeFromCart = (id) => {
// 	store.commit('removeFromCart', id)
// 	console.log(store.state.cart)
// };
</script>
 
<template>
	<Head title="User Profile" />

	<AppLayout>
		<template #header>
			<h2 class="flex  font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				<Link :href="route('indexBooking')" class="mr-3"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24"
					width="24" height="24">
					<path
						d="M7.82843 10.9999H20V12.9999H7.82843L13.1924 18.3638L11.7782 19.778L4 11.9999L11.7782 4.22168L13.1924 5.63589L7.82843 10.9999Z"
						class="fill-gray-400"></path>
				</svg></Link>
				Booking ID : {{ booking.id }}
			</h2>
		</template>




		<div class="pt-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div
					class="first-letter:bg-white dark:bg-gray-800 dark:bg-opacity-20 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">

					<div class="grid sm:grid-cols-2 lg:grid-cols-2 gap-5">




						<div class="relative overflow-x-auto">
							<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
								<thead
									class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
									<tr>
									</tr>
								</thead>
								<tbody>
									<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
										<th scope="row"
											class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
											Nama Lengkap
										</th>
										<td class="px-6 py-4">
											{{ booking.nama_pelanggan }}
										</td>
									</tr>
									<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
										<th scope="row"
											class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
											Nomor HP
										</th>
										<td class="px-6 py-4">
											{{ booking.nomor_hp }}
										</td>
									</tr>
									<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
										<th scope="row"
											class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
											Alamat
										</th>
										<td class="px-6 py-4">
											{{ booking.alamat }}
										</td>
									</tr>
									<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
										<th scope="row"
											class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
											Email
										</th>
										<td class="px-6 py-4">
											{{ booking.email }}
										</td>
									</tr>
									<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
										<th scope="row"
											class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
											Lokasi Acara
										</th>
										<td class="px-6 py-4">
											{{ booking.lokasi_acara }}
										</td>
									</tr>
									<tr class="bg-white dark:bg-gray-800">
										<th scope="row"
											class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
											Tanggal Booking
										</th>
										<td class="px-6 py-4">
											{{ booking.tanggal_booking }}
										</td>
									</tr>
								</tbody>
							</table>
						</div>


						<div
							class=" flex flex-col justify-center text-center p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
							<div class="">

								<div>
									<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
										Kuitansi pembayaran</h5>
								</div>
								<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Daftar pembayaran yang sudah
									dilakukan oleh klien.</p>


								<ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
									aria-labelledby="dropdownHoverButton">
									<li v-for="k in  booking.kuitansis " class="p-2 ">
										<button class="w-full" @click="show = true; selectedKuitansi = k; form.id = k.id">
											<div
												class="flex w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
												<div class="mr-4">
												</div>
												<div class="pr-2 grid grid-cols-2 w-full">
													<div class="text-left">
														<h5
															class="py-1 text-md font-bold tracking-wide text-gray-900 dark:text-white">
															Rp{{ (k.nominal).toLocaleString() }}</h5>
														<p class="dark:text-gray-400 text-gray-600">{{ k.catatan }}</p>
													</div>
													<div class="flex items-center justify-end py-1">
														<span v-if=" k.valid "
															class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 capitalize">
															Terkonfirmasi </span>
														<span v-if=" !k.valid "
															class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300 capitalize">
															Pending </span>
														<!-- 
													<span
														class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 capitalize">{{
															k.ukuran }}</span>
													<span
														class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 capitalize">{{
															k.warna }}</span> -->

													</div>
												</div>
											</div>

										</button>
									</li>


								</ul>

								<!-- <a href="#"
									class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
									Konfirmasi
									<svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
										viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
										<path fill-rule="evenodd"
											d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
											clip-rule="evenodd"></path>
									</svg>
								</a> -->
							</div>
						</div>




					</div>

				</div>
			</div>
		</div>




		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="bg-white dark:bg-gray-800 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg">

					<ul class="py-2 text-sm text-gray-700 dark:text-gray-200" aria-labelledby="dropdownHoverButton">
						<li v-for=" bl  in  booking.booking_lists " class="p-2 ">
							<div
								class="grid grid-cols-2 p-3 w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

								<div class="pr-2">
									<a href="#">
										<h5 class="py-1 text-md font-bold tracking-wide text-gray-900 dark:text-white">
											{{ (bl.nama).substring(0, 15) }}</h5>
									</a>
									<div class="flex items-center py-1">
										<span
											class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">{{
											bl.tipe }}</span>
										<span
											class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 capitalize">{{
											bl.ukuran }}</span>
										<span
											class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 capitalize">{{
											bl.warna }}</span>

									</div>
								</div>
								<div class="flex flex-col text-right justify-end font-bold text-xl">
									Rp{{ (bl.harga).toLocaleString() }}
								</div>
							</div>

						</li>

					</ul>


				</div>
			</div>
		</div>



		<Modal :show=" show " :max-width=" maxWidth " :closeable=" closeable " @close=" close ">
			<form @submit.prevent=" ubahStatusKuitansi " enctype="multipart/form-data">

				<div class="bg-white dark:bg-gray-800 px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
					<div class="sm:flex sm:items-start">
						<div
							class="mx-auto shrink-0 flex items-center justify-center h-12 w-12 rounded-full bg-blue-200 sm:mx-0 sm:h-10 sm:w-10">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="20" height="20"
								class="fill-blue-800">
								<path
									d="M22.0049 7H23.0049V17H22.0049V20C22.0049 20.5523 21.5572 21 21.0049 21H3.00488C2.4526 21 2.00488 20.5523 2.00488 20V4C2.00488 3.44772 2.4526 3 3.00488 3H21.0049C21.5572 3 22.0049 3.44772 22.0049 4V7ZM20.0049 17H14.0049C11.2435 17 9.00488 14.7614 9.00488 12C9.00488 9.23858 11.2435 7 14.0049 7H20.0049V5H4.00488V19H20.0049V17ZM21.0049 15V9H14.0049C12.348 9 11.0049 10.3431 11.0049 12C11.0049 13.6569 12.348 15 14.0049 15H21.0049ZM14.0049 11H17.0049V13H14.0049V11Z">
								</path>
							</svg>
						</div>

						<div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">

							<h3 class="text-lg font-medium text-gray-900 dark:text-gray-100">
								Kuitansi Pembayaran
							</h3>

							<div class="mt-4 text-sm text-gray-600 dark:text-gray-400">


								<div class="p-5">
									<img :src=" selectedKuitansi.foto " alt="" class="rounded-lg">
								</div>


							</div>
						</div>
					</div>
				</div>

				<div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-900 text-right">

					<button type="button" @click=" show = false " :class=" { 'opacity-25': form.processing } "
						:disabled=" form.processing "
						class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>

					<button v-if=" !selectedKuitansi.valid " type="submit" :class=" { 'opacity-25': form.processing } "
						:disabled=" form.processing "
						class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">Konfirmasi
						Pembayaran</button>
					<button v-if=" selectedKuitansi.valid " type="submit" :class=" { 'opacity-25': form.processing } "
						:disabled=" form.processing "
						class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">Batalkan Konfirmasi
						Pembayaran</button>
				</div>
			</form>

		</Modal>


</AppLayout></template>