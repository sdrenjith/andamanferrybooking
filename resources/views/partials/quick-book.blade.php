{{-- resources/views/partials/quick-book.blade.php --}}
<section id="quick-book" class="container my-4">
  <div class="card shadow-sm">
    <div class="card-body">
      <h5 class="mb-3">Select Date & Time</h5>

      <form method="GET" action="{{ url('search-result-ferry') }}" class="row g-3 align-items-end">
        {{-- one-way by default; change to 2 if you want round trip --}}
        <input type="hidden" name="trip_type" value="{{ request('trip_type', 1) }}">

        <div class="col-12 col-md-3">
          <label class="form-label">From</label>
          <select name="form_location" class="form-select" required>
            @foreach(($ferry_locations ?? []) as $loc)
              <option value="{{ $loc->id }}"
                {{ (int)old('form_location', (int)request('form_location', 1)) === (int)$loc->id ? 'selected' : '' }}>
                {{ $loc->title }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">To</label>
          <select name="to_location" class="form-select" required>
            @foreach(($ferry_locations ?? []) as $loc)
              <option value="{{ $loc->id }}"
                {{ (int)old('to_location', (int)request('to_location', 2)) === (int)$loc->id ? 'selected' : '' }}>
                {{ $loc->title }}
              </option>
            @endforeach
          </select>
        </div>

        <div class="col-12 col-md-3">
          <label class="form-label">Date</label>
          <input type="date"
                 class="form-control"
                 name="date"
                 min="{{ date('Y-m-d') }}"
                 value="{{ old('date', request('date', date('Y-m-d'))) }}"
                 required>
        </div>

        <div class="col-6 col-md-1">
          <label class="form-label">Passengers</label>
          <input type="number" class="form-control" name="passenger"
                 value="{{ old('passenger', request('passenger', 1)) }}"
                 min="1" max="20" required>
        </div>

        <div class="col-6 col-md-1">
          <label class="form-label">Infants</label>
          <input type="number" class="form-control" name="infant"
                 value="{{ old('infant', request('infant', 0)) }}"
                 min="0" max="8">
        </div>

        <div class="col-12 col-md-1">
          <button class="btn btn-primary w-100">
            Book Now
          </button>
        </div>
      </form>
    </div>
  </div>
</section>
