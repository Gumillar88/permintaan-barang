<template>
  <AppLayout title="Daftar Permintaan">
    <div class="container py-4">
      <div class="row mb-3">
        <div class="col">
          <h1 class="h4">Daftar Permintaan Barang</h1>
        </div>
      </div>

      <div class="row mb-4">
        <div class="col-auto">
          <a href="/permintaan-barang/create" class="btn btn-primary">
            + Tambah Permintaan
          </a>
        </div>
      </div>

      <div class="row">
        <div class="col">
          <table id="permintaanTable" class="table table-bordered table-striped w-100">
            <thead class="table-light">
              <tr>
                <th>Peminta</th>
                <th>Departemen</th>
                <th>Tanggal</th>
                <th>Barang</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="req in filteredRequests" :key="req.id">
                <td>{{ req.user?.name || '-' }}</td>
                <td>{{ req.user?.department?.name || '-' }}</td>
                <td>{{ formatDate(req.created_at) }}</td>
                <td>
                  <ul class="mb-0 ps-3">
                    <li v-for="row in req.items" :key="row.id">
                      {{ row.item.name }} ({{ row.quantity }} {{ row.item.unit }}) -
                      <span :class="{
                        'text-success': row.status === 'terpenuhi',
                        'text-warning': row.status === 'sebagian',
                        'text-danger': row.status === 'kosong'
                      }">
                        {{ row.status }}
                      </span>
                    </li>
                  </ul>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
    </div>
  </AppLayout>
</template>


<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref, computed, watch, onMounted, nextTick } from 'vue';
import 'datatables.net-bs5';
import $ from 'jquery';

const props = defineProps({
  requests: { type: Array, required: true }
});

const searchQuery = ref('');

const filteredRequests = computed(() => {
  if (!searchQuery.value) return props.requests;
  return props.requests.filter(
    (req) => req.user?.name?.toLowerCase().includes(searchQuery.value.toLowerCase())
  );
});

const formatDate = (val) => new Date(val).toLocaleDateString();

let dataTable;

const initDataTable = () => {
  nextTick(() => {
    if ($.fn.dataTable.isDataTable('#permintaanTable')) {
      $('#permintaanTable').DataTable().destroy();
    }
    dataTable = $('#permintaanTable').DataTable();
  });
};

onMounted(() => {
  initDataTable();
});

watch(filteredRequests, () => {
  initDataTable();
});
</script>
