<header class="bg-zinc-800 text-zinc-100 py-4">
  <div class="container mx-auto flex items-center justify-between px-4">
      <h1 class="text-xl font-semibold">FlyHigh Airlines</h1>
      <nav>
          <ul class="flex space-x-4">
              <li><a href="{{ route('flights.list') }}" class="hover:text-zinc-300">Daftar Penerbangan</a></li>
              {{-- <li><a href="#" class="hover:text-zinc-300">Pesan Tiket</a></li> --}}
              {{-- <li><a href="#" class="hover:text-zinc-300">Tentang Kami</a></li> --}}
          </ul>
      </nav>
  </div>
</header>