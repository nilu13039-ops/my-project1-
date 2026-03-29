@extends('layouts.app')

@section('title', 'Joy Band Qilish')

@section('content')
    {{-- Hero Section --}}
    <section class="relative pt-32 pb-16 px-4 sm:px-6 lg:px-8 bg-gradient-to-r from-amber-600 to-amber-700 text-white">
        <div class="max-w-7xl mx-auto text-center">
            <h1 class="text-5xl sm:text-6xl font-black mb-6"
                style="font-family: var(--font-heading);">
                📅 Joy Band Qilish
            </h1>
            <p class="text-xl text-amber-100 max-w-2xl mx-auto">
                Restoranda o'z joyingizni band qiling. Biz sizni kutamiz va
                eng yaxshi xizmatni taqdim etamiz.
            </p>
        </div>
    </section>

    {{-- Reservation Form --}}
    <section class="py-16 px-4 sm:px-6 lg:px-8 bg-white">
        <div class="max-w-4xl mx-auto">
            <div class="bg-white rounded-3xl shadow-2xl border-2 border-gray-100 overflow-hidden">
                {{-- Header --}}
                <div class="bg-gradient-to-r from-amber-50 to-amber-100 px-8 py-6 border-b-2 border-gray-200">
                    <h2 class="text-3xl font-black text-gray-900 text-center">
                        🪑 Stol Band Qilish Formasi
                    </h2>
                </div>

                {{-- Form --}}
                <form method="POST" action="{{ route('reservation.store') }}"
                      class="p-8 space-y-8"
                      x-data="{
                          selectedTable: null,
                          guests: 1,
                          date: '',
                          time: '',
                          availableTables: {{ $tables->toJson() }},
                          filteredTables: [],

                          init() {
                              this.updateFilteredTables();
                          },

                          updateFilteredTables() {
                              this.filteredTables = this.availableTables.filter(table => {
                                  return table.capacity >= this.guests;
                              });
                          },

                          selectTable(tableId) {
                              this.selectedTable = tableId;
                          }
                      }"
                      x-init="init()">

                    @csrf

                    {{-- Guests Count --}}
                    <div>
                        <label class="block text-lg font-bold text-gray-900 mb-4">
                            👥 Mehmonlar Soni
                        </label>
                        <div class="grid grid-cols-2 sm:grid-cols-4 gap-4">
                            @for($i = 1; $i <= 8; $i++)
                            <button type="button"
                                    @click="guests = {{ $i }}; updateFilteredTables()"
                                    :class="guests === {{ $i }} ? 'bg-amber-600 text-white' : 'bg-gray-100 text-gray-700 hover:bg-amber-100'"
                                    class="p-4 rounded-2xl font-bold text-lg transition-all duration-300 hover:scale-105">
                                {{ $i }} kishi
                            </button>
                            @endfor
                        </div>
                        <input type="hidden" name="guests_count" x-model="guests" required>
                    </div>

                    {{-- Date & Time --}}
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-8">
                        <div>
                            <label for="reservation_date" class="block text-lg font-bold text-gray-900 mb-4">
                                📅 Band Qilish Sanasi
                            </label>
                            <input type="date"
                                   id="reservation_date"
                                   name="reservation_date"
                                   x-model="date"
                                   min="{{ date('Y-m-d') }}"
                                   class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl text-lg font-semibold focus:border-amber-500 focus:ring-0 transition-colors"
                                   required>
                        </div>

                        <div>
                            <label for="reservation_time" class="block text-lg font-bold text-gray-900 mb-4">
                                🕐 Band Qilish Vaqti
                            </label>
                            <select id="reservation_time"
                                    name="reservation_time"
                                    x-model="time"
                                    class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl text-lg font-semibold focus:border-amber-500 focus:ring-0 transition-colors"
                                    required>
                                <option value="">Vaqtni tanlang</option>
                                <option value="10:00">10:00</option>
                                <option value="11:00">11:00</option>
                                <option value="12:00">12:00</option>
                                <option value="13:00">13:00</option>
                                <option value="14:00">14:00</option>
                                <option value="15:00">15:00</option>
                                <option value="16:00">16:00</option>
                                <option value="17:00">17:00</option>
                                <option value="18:00">18:00</option>
                                <option value="19:00">19:00</option>
                                <option value="20:00">20:00</option>
                                <option value="21:00">21:00</option>
                                <option value="22:00">22:00</option>
                            </select>
                        </div>
                    </div>

                    {{-- Available Tables --}}
                    <div x-show="filteredTables.length > 0">
                        <label class="block text-lg font-bold text-gray-900 mb-4">
                            🪑 Mavjud Stollar ({{ $tables->count() }} ta)
                        </label>
                        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                            <template x-for="table in filteredTables" :key="table.id">
                                <button type="button"
                                        @click="selectTable(table.id)"
                                        :class="selectedTable === table.id ? 'ring-4 ring-amber-500 bg-amber-50 border-amber-500' : 'hover:border-amber-300'"
                                        class="p-6 border-2 border-gray-200 rounded-2xl text-left transition-all duration-300 hover:shadow-lg">
                                    <div class="flex items-center justify-between mb-4">
                                        <span class="text-2xl font-black text-gray-900" x-text="table.name"></span>
                                        <span class="text-sm font-bold px-3 py-1 rounded-full"
                                              :class="selectedTable === table.id ? 'bg-amber-200 text-amber-800' : 'bg-gray-100 text-gray-600'">
                                            <span x-text="table.capacity"></span> kishilik
                                        </span>
                                    </div>
                                    <div class="text-sm text-gray-600 font-semibold">
                                        <span x-text="table.location || 'Markaziy zal'"></span>
                                    </div>
                                    <input type="radio" name="table_id" :value="table.id" x-model="selectedTable" class="hidden">
                                </button>
                            </template>
                        </div>
                    </div>

                    {{-- No Tables Available --}}
                    <div x-show="filteredTables.length === 0 && guests > 0" class="text-center py-12">
                        <div class="text-6xl mb-6">😔</div>
                        <h3 class="text-2xl font-black text-gray-900 mb-4">Mavjud Stol Yo'q</h3>
                        <p class="text-gray-600 text-lg">
                            Kechirasiz, <span x-text="guests"></span> kishilik stol mavjud emas.
                            Kamroq mehmon bilan urinib ko'ring yoki boshqa vaqtni tanlang.
                        </p>
                    </div>

                    {{-- Notes --}}
                    <div>
                        <label for="notes" class="block text-lg font-bold text-gray-900 mb-4">
                            📝 Qo'shimcha Izohlar (ixtiyoriy)
                        </label>
                        <textarea id="notes"
                                  name="notes"
                                  rows="4"
                                  placeholder="Alohida talablaringiz yoki izohlaringiz..."
                                  class="w-full px-6 py-4 border-2 border-gray-300 rounded-2xl text-lg focus:border-amber-500 focus:ring-0 transition-colors resize-none"></textarea>
                    </div>

                    {{-- Submit Button --}}
                    <div class="text-center pt-8">
                        <button type="submit"
                                :disabled="!selectedTable || !date || !time"
                                :class="!selectedTable || !date || !time ? 'opacity-50 cursor-not-allowed' : 'hover:shadow-2xl hover:scale-105'"
                                class="bg-amber-600 hover:bg-amber-700 text-white px-12 py-4 rounded-2xl font-bold text-xl transition-all duration-300">
                            ✅ Band Qilishni Tasdiqlash
                        </button>
                    </div>
                </form>
            </div>

            {{-- Info Cards --}}
            <div class="grid grid-cols-1 sm:grid-cols-3 gap-8 mt-12">
                <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-8 rounded-3xl text-center border-2 border-blue-200">
                    <div class="text-5xl mb-4">🕐</div>
                    <h3 class="text-xl font-black text-blue-900 mb-2">Ish Vaqti</h3>
                    <p class="text-blue-700 font-semibold">10:00 - 22:00</p>
                    <p class="text-blue-600 text-sm">Har kuni</p>
                </div>

                <div class="bg-gradient-to-br from-green-50 to-green-100 p-8 rounded-3xl text-center border-2 border-green-200">
                    <div class="text-5xl mb-4">📞</div>
                    <h3 class="text-xl font-black text-green-900 mb-2">Aloqa</h3>
                    <p class="text-green-700 font-semibold">+998 90 123 45 67</p>
                    <p class="text-green-600 text-sm">24/7 qo'ng'iroq</p>
                </div>

                <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-8 rounded-3xl text-center border-2 border-purple-200">
                    <div class="text-5xl mb-4">🚗</div>
                    <h3 class="text-xl font-black text-purple-900 mb-2">Parking</h3>
                    <p class="text-purple-700 font-semibold">Bepul Parking</p>
                    <p class="text-purple-600 text-sm">24 soat</p>
                </div>
            </div>
        </div>
    </section>
@endsection