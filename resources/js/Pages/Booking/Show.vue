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
	kuitansiValid: {
		type: Array,
		default: [],
	},
});

const close = () => {
	emit('close');
};

const form = useForm({
	booking_id: props.booking.id,
	nominal: "",
	catatan: "",
	foto: "",
});

const buatKuitansi = () => {
	form.transform((data) => ({
		...data
	})).post(route("buatKuitansi"), {
		onFinish: () => {
			show = false;
			form.reset("nominal");
			form.reset("catatan");
			form.reset("foto");
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
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				Booking ID : {{ booking.id }}
			</h2>
		</template>




		<div class="pt-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div
					class="first-letter:bg-white dark:bg-gray-800 dark:bg-opacity-20 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">

					<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">




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
							class="max-w-sm flex flex-col justify-center text-center p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
							<div>

								<!-- <a href="#">
									<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
										Rekening
										pembayaran</h5>
								</a> -->
								<span v-if="!(kuitansiValid).length"
									class="bg-red-100 text-red-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300">Belum
									Dibayar</span>
								<span
									v-if="(kuitansiValid).length && (props.booking.booking_lists).reduce((total, obj) => obj.harga + total, 0) - (props.kuitansiValid).reduce((total, obj) => obj.nominal + total, 0) != 0"
									class="bg-yellow-100 text-yellow-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-yellow-900 dark:text-yellow-300">Dibayar
									Sebagian</span>

								<span
									v-if="(kuitansiValid).length && (props.booking.booking_lists).reduce((total, obj) => obj.harga + total, 0) - (props.kuitansiValid).reduce((total, obj) => obj.nominal + total, 0) == 0"
									class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300">Sudah
									Lunas</span>


								<div
									v-if="(kuitansiValid).length && (props.booking.booking_lists).reduce((total, obj) => obj.harga + total, 0) - (props.kuitansiValid).reduce((total, obj) => obj.nominal + total, 0) == 0">
									<p class="mb-3 mt-4 font-normal text-gray-700 dark:text-gray-400">Terima kasih! Pembayaran anda sudah lunas.</p>
								</div>
								<div v-else>
									<p class="mb-3 mt-4 font-normal text-gray-700 dark:text-gray-400">Lakukan pembayaran ke
										rekening
										pembayaran di bawah ini:</p>
									<p class=" text-gray-700 dark:text-gray-200 font-bold">BNI 0309232603</p>
									<p class="mb-3 text-gray-700 dark:text-gray-200 font-bold">a/n Firman Adiyuda</p>
									<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Jika sudah melakukan
										pembayaran
										silahkan melakukan konfirmasi pembayaran disini.</p>
									<button @click="show = true"
										class="inline-flex items-center px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
										Konfirmasi
										<svg aria-hidden="true" class="w-4 h-4 ml-2 -mr-1" fill="currentColor"
											viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
											<path fill-rule="evenodd"
												d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
												clip-rule="evenodd"></path>
										</svg>
									</button>
								</div>

							</div>
						</div>






						<div
							class="max-w-sm flex flex-col justify-center text-center p-6 bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
							<div class="">

								<a href="#">
									<h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
										Kuitansi pembayaran</h5>
								</a>
								<p class="mb-3 font-normal text-gray-700 dark:text-gray-400">Jika pembayaran sudah
									dikonfirmasi oleh admin, kuitansi akan muncul disini.</p>


								<ul class="py-2 text-sm text-gray-700 dark:text-gray-200"
									aria-labelledby="dropdownHoverButton">
									<li v-for="k in booking.kuitansis" class="p-2 ">
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
													<span v-if="k.valid"
														class="bg-green-100 text-green-800 text-sm font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-green-900 dark:text-green-300 capitalize">
														Terkonfirmasi </span>
													<span v-if="!k.valid"
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
						<li v-for="bl in booking.booking_lists" class="p-2 ">
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



		<Modal :show="show" :max-width="maxWidth" :closeable="closeable" @close="close">
			<form @submit.prevent="buatKuitansi" enctype="multipart/form-data">

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
								Konfirmasi Pembayaran
							</h3>

							<div class="mt-4 text-sm text-gray-600 dark:text-gray-400">


								<div class="p-5">
									<div>
										<TextInput id="nominal" label="Nominal Pembayaran" v-model="form.nominal"
											v-model:error-message="form.errors.nominal" type="number"
											class="mt-1 block w-full" required autocomplete="nominal" />
									</div>

									<div class="mt-4">
										<TextArea id="catatan" label="Catatan (opsional)" rows="4" v-model="form.catatan"
											v-model:error-message="form.errors.catatan" type="text"
											class="mt-1 block w-full" autocomplete="catatan" />
									</div>

									<div class="mt-4">
										<label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white"
											for="foto">Foto bukti transaksi
										</label>
										<input
											class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400"
											id="foto" name="foto" type="file" @input="form.foto = $event.target.files"
											required>
									</div>
								</div>


							</div>
						</div>
					</div>
				</div>

				<div class="flex flex-row justify-end px-6 py-4 bg-gray-100 dark:bg-gray-900 text-right">
					<div class="rounded-full w-full justify-center flex flex-col mr-5">
						<div v-if="form.progress"
							class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-1 leading-none rounded-full"
							:style="'width: ' + form.progress.percentage + '%'"> {{ form.progress.percentage }}%
						</div>
					</div>

					<button type="button" @click="show = false" :class="{ 'opacity-25': form.processing }"
						:disabled="form.processing"
						class="py-2.5 px-5 mr-2 mb-2 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Batal</button>

					<button type="submit" :class="{ 'opacity-25': form.processing }" :disabled="form.processing"
						class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Konfirmasi</button>

				</div>
			</form>

		</Modal>


	</AppLayout>
</template>