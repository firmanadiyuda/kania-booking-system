<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { Head, Link, useForm } from '@inertiajs/vue3';
import ConfirmationModal from '@/Components/ConfirmationModal.vue';
import SecondaryButton from '@/Components/SecondaryButton.vue';
import DangerButton from '@/Components/DangerButton.vue';
import { ref } from 'vue';

const props = defineProps(['busana']);

const hapusBusanaForm = useForm({});
const busanaAkanDihapus = ref(null);

const confirmBusanaAkanDihapus = (id) => {
	busanaAkanDihapus.value = id;
};

const hapusBusana = () => {
	hapusBusanaForm.delete(route('hapusBusana', { 'id' : busanaAkanDihapus.value }), {
		onSuccess: () => (busanaAkanDihapus.value = null),
	})
};

</script>
 
<template>
	<Head title="User Profile" />

	<AppLayout>
		<template #header>
			<h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
				Daftar Busana
			</h2>
		</template>

		<div class="py-12">
			<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
				<div
					class="first-letter:bg-white dark:bg-gray-800 dark:bg-opacity-20 dark:text-gray-200 overflow-hidden shadow-xl sm:rounded-lg p-5">

					<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-5">

						<Link :href="route('createFormBusana')"
							class="flex flex-col justify-center p-6 bg-white border-2 border-dotted border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800/50 dark:border-gray-500 dark:hover:bg-gray-700 text-center"
							:class="{ 'lg:col-span-3': !busana.length }">
						<h5 class="mb-2 text-7xl font-bold tracking-tight text-gray-900 dark:text-white">+</h5>
						<p class="font-normal text-gray-700 dark:text-gray-400">Buat Busana Baru</p>
						</Link>

						<div v-for="b in busana"
							class="bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
							<a href="#">
								<!-- <img class="rounded-t-lg" :src="b.fotos[0].path" alt="product image" /> -->


								<div :id="b.id" class="relative w-full" data-carousel="slide">
									<!-- Carousel wrapper -->
									<div class="relative h-52 overflow-hidden rounded-lg">
										<!-- Item 1 -->
										<div v-for="foto in b.fotos" class="hidden duration-700 ease-in-out"
											data-carousel-item>
											<img :src="foto.path"
												class="absolute block w-full -translate-x-1/2 -translate-y-1/2 top-1/2 left-1/2"
												alt="...">
										</div>
									</div>
									<!-- Slider indicators -->
									<div class="absolute z-30 flex space-x-3 -translate-x-1/2 bottom-5 left-1/2">
										<button v-for="(foto, index) in b.fotos" :key="foto.id" type="button"
											class="w-3 h-3 rounded-full" aria-current="true"
											:data-carousel-slide-to="index"></button>
									</div>
									<!-- Slider controls -->
									<button type="button"
										class="absolute top-0 left-0 z-30 flex items-center justify-center h-full px-4 cursor-pointer group focus:outline-none"
										data-carousel-prev>
										<span
											class="inline-flex items-center justify-center w-8 h-8 rounded-full sm:w-10 sm:h-10 bg-white/30 dark:bg-gray-800/30 group-hover:bg-white/50 dark:group-hover:bg-gray-800/60 group-focus:ring-4 group-focus:ring-white dark:group-focus:ring-gray-800/70 group-focus:outline-none">
											<svg aria-hidden="true"
												class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
												stroke="currentColor" viewBox="0 0 24 24"
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
											<svg aria-hidden="true"
												class="w-5 h-5 text-white sm:w-6 sm:h-6 dark:text-gray-800" fill="none"
												stroke="currentColor" viewBox="0 0 24 24"
												xmlns="http://www.w3.org/2000/svg">
												<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
													d="M9 5l7 7-7 7"></path>
											</svg>
											<span class="sr-only">Next</span>
										</span>
									</button>
								</div>


							</a>
							<div class="px-5 pb-5 mt-5">
								<a href="#">
									<h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white">
										{{ b.nama }}</h5>
								</a>
								<div class="flex items-center mt-2.5 mb-5">
									<span
										class="bg-blue-100 text-blue-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-blue-900 dark:text-blue-300 capitalize">{{
											b.tipe }}</span>
									<span
										class="bg-red-100 text-red-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-red-900 dark:text-red-300 capitalize">{{
											b.ukuran }}</span>
									<span
										class="bg-gray-100 text-gray-800 text-xs font-medium mr-2 px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-gray-300 capitalize">{{
											b.warna }}</span>

								</div>
								<div class="flex items-center justify-between">
									<span class="text-3xl font-bold text-gray-900 dark:text-white">Rp{{
										(b.harga).toLocaleString() }}</span>
									<!-- <a href="#"
										class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Add
										to cart</a> -->

									<div class="inline-flex rounded-md shadow-sm" role="group">
										<Link type="button" :href="route('editFormBusana', id = b.id)"
											class="px-4 py-2 text-sm font-medium text-gray-900 bg-gray-900 border border-gray-200 rounded-l-lg hover:bg-gray-600 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-blue-500 dark:focus:text-white">
										<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18" height="18">
											<path
												d="M15.7279 9.57629L14.3137 8.16207L5 17.4758V18.89H6.41421L15.7279 9.57629ZM17.1421 8.16207L18.5563 6.74786L17.1421 5.33365L15.7279 6.74786L17.1421 8.16207ZM7.24264 20.89H3V16.6474L16.435 3.21233C16.8256 2.8218 17.4587 2.8218 17.8492 3.21233L20.6777 6.04075C21.0682 6.43128 21.0682 7.06444 20.6777 7.45497L7.24264 20.89Z"
												class="fill-gray-300"></path>
										</svg>
										</Link>
										<button type="button" @click="confirmBusanaAkanDihapus(b.id)"
											class="px-4 py-2 text-sm font-medium bg-red-800 border border-gray-200 rounded-r-md hover:bg-red-600 hover:text-blue-700 focus:z-10 focus:ring-2 focus:ring-blue-700 focus:text-blue-700 dark:bg-red-800 dark:border-gray-600 dark:hover:text-white dark:hover:bg-red-600 dark:focus:ring-blue-500 dark:focus:text-white">
											<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="18"
												height="18">
												<path
													d="M17 6H22V8H20V21C20 21.5523 19.5523 22 19 22H5C4.44772 22 4 21.5523 4 21V8H2V6H7V3C7 2.44772 7.44772 2 8 2H16C16.5523 2 17 2.44772 17 3V6ZM18 8H6V20H18V8ZM9 11H11V17H9V11ZM13 11H15V17H13V11ZM9 4V6H15V4H9Z"
													class="fill-gray-300"></path>
											</svg>
										</button>
									</div>

								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<ConfirmationModal :show="busanaAkanDihapus != null" @close="busanaAkanDihapus = null">
			<template #title>
				Hapus Busana
			</template>

			<template #content>
				Yakin ingin menghapus busana?
			</template>

			<template #footer>
				<SecondaryButton @click="busanaAkanDihapus = null">
					Batal
				</SecondaryButton>

				<DangerButton class="ml-3" :class="{ 'opacity-25': hapusBusanaForm.processing }"
					:disabled="hapusBusanaForm.processing" @click="hapusBusana">
					Hapus
				</DangerButton>
			</template>
		</ConfirmationModal>

	</AppLayout>
</template>