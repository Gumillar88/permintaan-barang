<template>
  <div class="min-h-screen bg-gray-100">
    <header class="bg-white shadow">
      <div class="max-w-7xl mx-auto py-4 px-6 flex justify-between items-center">
        <div class="space-x-4">
          <Link href="/dashboard" class="text-blue-600 font-semibold">Dashboard</Link>
          <Link href="/permintaan-barang" class="text-blue-600 font-semibold">Permintaan Barang</Link>
        </div>
        <div>
          <span class="text-gray-700 mr-2">{{ $page.props.auth.user.name }}</span>
          <Link href="/logout" method="post" as="button" class="text-red-600">Logout</Link>
        </div>
      </div>
    </header>

    <main class="py-6">
      <slot />
    </main>
  </div>
</template>

<script setup>
import { Link } from '@inertiajs/vue3'
</script>