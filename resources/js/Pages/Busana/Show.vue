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
	busana: {
		type: Array,
		default: [],
	},
});

const close = () => {
	emit('close');
};

const form = useForm({
	nominal: "",
	catatan: "",
	foto: "",
});

const addToCart = (payload) => {
	store.commit('addToCart', payload)
	console.log(store.state.cart)
};

const removeFromCart = (id) => {
	store.commit('removeFromCart', id)
	console.log(store.state.cart)
};

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

</script>
 
<template>
	<Head :title="busana.nama" />

	<AppLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				{{ busana.nama }}
			</h2>
		</template>




		<div class="pt-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div class="first-letter:bg-white  dark:text-gray-200 overflow-hidden sm:rounded-lg p-5">
					<div class="grid sm:grid-cols-12 gap-5">

						<div class=" col-span-4 bg-gray-800 rounded-xl">

							<div :id="busana.id" class="relative w-full" data-carousel="slide">
								<!-- Carousel wrapper -->
								<div class="relative h-52 overflow-hidden rounded-t-lg">
									<!-- Item 1 -->
									<div v-for="foto in busana.fotos" class="hidden duration-700 ease-in-out"
										data-carousel-item>
										<img :src="foto.path"
											class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
											alt="...">
									</div>
								</div>
								<!-- Slider indicators -->
								<div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
									<button v-for="(foto, index) in busana.fotos" :key="foto.id" type="button"
										class="w-3 h-3 rounded-full" aria-current="true"
										:data-carousel-slide-to="index"></button>
								</div>
								<!-- Slider controls -->
								<button type="button"
									class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
									data-carousel-prev>
									<span
										class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
										<svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
											fill="none" stroke="currentColor" viewBox="0 0 24 24"
											xmlns="http://www.w3.org/2000/svg">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M15 19l-7-7 7-7"></path>
										</svg>
										<span class="sr-only">Previous</span>
									</span>
								</button>
								<button type="button"
									class="absolute top-0 right-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
									data-carousel-next>
									<span
										class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
										<svg aria-hidden="true" class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800"
											fill="none" stroke="currentColor" viewBox="0 0 24 24"
											xmlns="http://www.w3.org/2000/svg">
											<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
												d="M9 5l7 7-7 7"></path>
										</svg>
										<span class="sr-only">Next</span>
									</span>
								</button>
							</div>


							<div class="relative overflow-x-auto">
								<table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
									<thead
										class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
										<tr>
											<th scope="col" colspan="2" class="px-6 py-3 text-center">
												Spesifikasi
											</th>
										</tr>
									</thead>
									<tbody>
										<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
											<th scope="row"
												class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
												Tipe
											</th>
											<td class="px-6 py-4 capitalize">
												: {{ busana.tipe }}
											</td>
										</tr>
										<tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
											<th scope="row"
												class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
												Warna
											</th>
											<td class="px-6 py-4 capitalize">
												: {{ busana.warna }}
											</td>
										</tr>
										<tr class="bg-white dark:bg-gray-800">
											<th scope="row"
												class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
												Ukuran
											</th>
											<td class="px-6 py-4 capitalize">
												: {{ busana.ukuran }}
											</td>
										</tr>
									</tbody>
								</table>
							</div>

						</div>



						<div class="col-span-8">


							<div
								class=" bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">

								<div class="p-6">

									<h5 class="mb-5 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
										{{ busana.nama }}</h5>
									<hr class="border-gray-500">
									<p class="mb-1 mt-5 font-normal text-gray-700 dark:text-gray-400 whitespace-pre-wrap">
										{{ busana.deskripsi }}</p>

								</div>
								<div class="bg-gray-300 dark:bg-gray-700 p-5 rounded-b-lg">

									<button type="button" @click="addToCart(busana)" v-if="!store.state.cart[busana.id]"
										class="flex text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
											class="fill-gray-300 mr-2">
											<path
												d="M4.00436 6.41662L0.761719 3.17398L2.17593 1.75977L5.41857 5.00241H20.6603C21.2126 5.00241 21.6603 5.45012 21.6603 6.00241C21.6603 6.09973 21.6461 6.19653 21.6182 6.28975L19.2182 14.2898C19.0913 14.7127 18.7019 15.0024 18.2603 15.0024H6.00436V17.0024H17.0044V19.0024H5.00436C4.45207 19.0024 4.00436 18.5547 4.00436 18.0024V6.41662ZM6.00436 7.00241V13.0024H17.5163L19.3163 7.00241H6.00436ZM5.50436 23.0024C4.67593 23.0024 4.00436 22.3308 4.00436 21.5024C4.00436 20.674 4.67593 20.0024 5.50436 20.0024C6.33279 20.0024 7.00436 20.674 7.00436 21.5024C7.00436 22.3308 6.33279 23.0024 5.50436 23.0024ZM17.5044 23.0024C16.6759 23.0024 16.0044 22.3308 16.0044 21.5024C16.0044 20.674 16.6759 20.0024 17.5044 20.0024C18.3328 20.0024 19.0044 20.674 19.0044 21.5024C19.0044 22.3308 18.3328 23.0024 17.5044 23.0024Z">
											</path>
										</svg>
										Masukkan keranjang</button>

									<button type="button" @click="removeFromCart(busana.id)"
										v-if="store.state.cart[busana.id]"
										class="flex focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm px-5 py-2.5 mr-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18"
											class="fill-gray-300 mr-2">
											<path
												d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z">
											</path>
										</svg>
										Hapus</button>

								</div>

							</div>


						</div>



					</div>
				</div>
			</div>
		</div>



	</AppLayout>
</template>