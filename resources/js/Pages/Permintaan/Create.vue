<template>
  <AppLayout title="Buat Permintaan">
    <div class="container py-4">
      <h1 class="h4 mb-4">Buat Permintaan Barang</h1>

      <form @submit.prevent="submit">
        <div v-for="(row, index) in form.items" :key="index" class="border rounded p-3 mb-3">
          <div class="mb-2">
            <label class="form-label">Pilih Barang</label>
            <select class="form-select" name="item_id" v-model="row.item_id">
              <option disabled value="">-- pilih --</option>
              <option v-for="item in items" :key="item.id" :value="item.id">
                {{ item.name }} ({{ item.stock }} {{ item.unit }})
              </option>
            </select>
          </div>

          <div class="mb-2">
            <label class="form-label">Jumlah</label>
            <input type="number" name="quantity" min="1" class="form-control" v-model.number="row.quantity" />
          </div>

          <div class="mb-2">
            <small>
              Status:
              <span v-if="selectedItem(index)?.stock === 0" class="text-danger">Kosong</span>
              <span v-else-if="row.quantity > selectedItem(index)?.stock" class="text-warning">Sebagian</span>
              <span v-else class="text-success">Terpenuhi</span>
            </small>
          </div>

          <button type="button" class="btn btn-sm btn-outline-danger" @click="removeItem(index)">Hapus</button>
        </div>

        <div class="d-flex justify-content-between align-items-center">
          <button type="button" class="btn btn-outline-primary" @click="addItem">+ Tambah Barang</button>
          <button type="submit" class="btn btn-success">Kirim Permintaan</button>
        </div>
      </form>
    </div>
  </AppLayout>
</template>

<script setup>
import AppLayout from '@/Layouts/AppLayout.vue';
import { ref } from 'vue';
import { router } from '@inertiajs/vue3';

const props = defineProps({
  items: Array
});

const form = ref({
  items: [
    { item_id: '', quantity: 1 }
  ]
});

const addItem = () => form.value.items.push({ item_id: '', quantity: 1 });
const removeItem = (index) => form.value.items.splice(index, 1);

const selectedItem = (index) => {
  return props.items.find(i => i.id === Number(form.value.items[index].item_id));
};

const submit = () => {
  const valid = form.value.items.every(item =>
    item.item_id && Number(item.item_id) > 0 && Number(item.quantity) >= 1
  );

  console.log("This is: " + valid);
  if (!valid) {
    alert('Pastikan semua item telah dipilih dan jumlah minimal 1.');
    return;
  }

  const payload = {
    items: form.value.items.map(item => ({
      item_id: Number(item.item_id),
      quantity: Number(item.quantity)
    }))
  };

  router.post('/permintaan-barang/save', payload, {
    onSuccess: () => alert('Permintaan berhasil dikirim!'),
    onError: (errors) => {
      console.error(errors);
      alert('Validasi gagal, periksa kembali inputan Anda.');
    }
  });
};
</script>

