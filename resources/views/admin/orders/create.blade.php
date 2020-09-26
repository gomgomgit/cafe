@extends('admin.layouts.app')

@section('head-script')

<!-- Favicon icon -->
<link rel="icon" href="{{ asset('dattalite/assets/images/favicon.ico') }}" type="image/x-icon">
<!-- fontawesome icon -->
<link rel="stylesheet" href="{{ asset('dattalite/assets/fonts/fontawesome/css/fontawesome-all.min.css') }}">
<!-- animation css -->
<link rel="stylesheet" href="{{ asset('dattalite/assets/plugins/animation/css/animate.min.css') }}">
<!-- vendor css -->
<link rel="stylesheet" href="{{ asset('dattalite/assets/css/style.css') }}">

{{-- Select2 --}}
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" integrity="sha512-nMNlpuaDPrqlEls3IX/Q56H36qvBASwb3ipuo3MxeWbsQB1881ox0cRv7UPTgBlriqoynt35KjEwgGUeUXIPnw==" crossorigin="anonymous" />

<link rel="stylesheet" type="text/css" href="{{ asset('css/s2custom.css') }}">

<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/@ttskch/select2-bootstrap4-theme@1.4.0/dist/select2-bootstrap4.min.css">

@endsection

@section('title', 'Order')
@section('breadcrumb')
	<ul class="breadcrumb">
	    <li class="breadcrumb-item"><a href="index.html"><i class="feather icon-home"></i></a></li>
	    <li class="breadcrumb-item"><a href="{{ route('admin.categories.index') }}">Order</a></li>
	    <li class="breadcrumb-item"><a href="javascript:">Add Order</a></li>
	</ul>
@endsection

@section('main-content')

  <!-- [ Main Content ] start -->
  <div class="row">
      <div class="col-sm-12">
          <div class="card">
              <div class="card-header">
                  <h5>Create Order</h5>

                  <form method="post" action="{{ route('admin.orders.store') }}">
                    @csrf
                    <div class="card-block table-border-style">
                    <div>
                      <div class="form-group">
                          <label for="exampleInputEmail1" class="text-dark h6">Customer Name</label>
                          <input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name" name="customer" value="{{ old('customer') }}">
                      </div>
                    </div>
                        <div class="table-responsive" x-data="alpine()" x-init="() => { initSelect() }">
                            <table class="table table-hover">
                                {{-- <thead>
                                    <tr>
                                        <th>NO</th>
                                        <th>ITEM</th>
                                        <th>VARIANT</th>
                                        <th>SIZE</th>
                                        <th>PRICE</th>
                                    </tr>
                                </thead> --}}
                                <template x-for="(row, index) in rows" :key="row">
                                  <tbody>
                                      <tr>
                                          <th scope="row" class="h5"><span x-text="index + 1"></span></th>
                                          <td colspan="2">
                                            <select
                                              class="form-control w-100 selectdua"
                                              :class="'rowitem' + index"
                                              x-model="row.item_id"
                                              {{-- x-on:change="setDetail(row.item_id, index)" --}}
                                              style="display: none;"
                                            >
                                              <option>-Select Item-</option>
                                              @foreach($items as $item)
                                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                              @endforeach
                                            </select>
                                            <input type="hidden" name="itemdetail[]" x-model="row.detail">
                                          </td>
                                          <td colspan="2">
                                              <select
                                              class="form-control w-100 selectdua"
                                              :class="'rowvariant' + index"
                                              x-model="row.variant_id" x-on:change="setItemDetail(index)"
                                              style="display: none;"
                                              >
                                                <option>- Select Variant -</option>

                                                <template x-for="variant in row.variants" :key="variant">
                                                  <option x-text="variant.name" x-model="variant.id"></option>
                                                </template>

                                              </select>
                                          </td>
                                          <td colspan="2">
                                              <select
                                              class="form-control w-100 selectdua"
                                              :class="'rowsize' + index"
                                              x-model="row.size_id" x-on:change="setItemDetail(index)"
                                              style="display: none;"
                                              >
                                                  <option>- Size select -</option>

                                                  <template x-for="size in row.sizes" :key="size.id">
                                                    <option x-text="size.name" x-model="size.id"></option>
                                                  </template>

                                              </select>
                                          </td>
                                          <td width="90px">
                                            <button
                                              type="button" class="btn btn-danger"
                                              x-on:click="removeOrder(index)"
                                            >
                                              <i class="feather icon-trash h5"></i>Delete
                                            </button>
                                          </td>
                                      </tr>
                                      <tr>
                                          <th scope="row">
                                            {{-- <template x-for="i in row.ingredient" :key="i.id">
                                              <span x-text="i.name"></span>
                                            </template> --}}
                                          </th>
                                          <td class="h6">PRICE</td>
                                          <td class="h6">
                                            Rp. <span x-text="row.price"></span>
                                          </td>
                                          <td class="h6">QTY</td>
                                          <td>
                                            <input type="number" name="qty[]" class="form-control"
                                              style="width: 100px"
                                              x-model="row.qty"
                                              x-on:change="setSubtotal(index)"
                                            >
                                          </td>
                                          <td class="h6">SUBTOTAL: </td>
                                          <td>
                                            <p class="h6">Rp.<span x-text="row.subtotal"></span></p>
                                            <input type="hidden" name="subtotal[]" x-model="row.subtotal">
                                          </td>
                                          <td></td>
                                      </tr>
                                      {{-- <template x-for="ingr in row.ingre" :key="ingr.id">
                                        <p x-text="ingr.name"></p>
                                      </template> --}}
                                  </tbody>
                                </template>

                                <tfoot>
                                  <tr class="h5 font-weight-bold">
                                    <td width="30px"><button class="btn btn-info m-0" type="button" x-on:click=addOrder >
                                      <i class="feather icon-plus h5"></i>Add
                                    </button></td>
                                    <td colspan="4">TOTAL</td>
                                    <td>Rp.</td>
                                    <td><span x-text="total"></span>
                                      <input type="hidden" name="total" x-model="total">
                                    </td>
                                    <td>
                                      <button class="btn btn-info w-100"><i class="feather icon-shopping-cart h5"></i>Order</button>
                                    </td>
                                  </tr>
                                </tfoot>
                            </table>

                            {{-- <template x-for="(ingredient,index) in ingredients" :key="ingredient">
                              <p x-text="ingredient.name + ' ' + ingredient.stock"></p>
                            </template> --}}
                        </div>
                    </div>
                  </form>

                  </div>
              </div>
          </div>
      </div>
  </div>
  <!-- [ Main Content ] end -->

@endsection

@section('end-script')

    <!-- Required Js -->
{{-- <script src="{{ asset('dattalite/assets/js/vendor-all.min.js') }}"></script>
  <script src="{{ asset('dattalite/assets/plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('dattalite/assets/js/pcoded.min.js') }}"></script> --}}

    <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.7.0/dist/alpine.min.js" defer></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js" integrity="sha512-bLT0Qm9VnAYZDflyKcBaQ2gg0hSYNQrJ8RilYldYQ1FxQYoCLtUjuuRuZo+fjqhx/qtq/1itJ0C2ejDxltZVFg==" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js" integrity="sha512-2ImtlRlf2VVmiGZsjm9bEyhjGW4dU7B6TNwh/hx/iSByxNENtj3WVE6o/9Lj4TJeVXPi4bnOIMXFIJJAeufa0A==" crossorigin="anonymous"></script>

    {{-- <script src="https://cdn.jsdelivr.net/npm/skipper-slider@1.2.1/Gruntfile.min.js"></script> --}}

    {{-- Ramda --}}
    {{-- buat distict --}}
    <script src="//cdnjs.cloudflare.com/ajax/libs/ramda/0.25.0/ramda.min.js"></script>

    <script type="text/javascript">
      function alpine() {
        const initialRow = {
          detail: null,
          item_id: null,
          variants: [],
          sizes:[],
          // ingredient: [],
          variant_id: 0,
          size_id: 0,
          price: 0,
          qty: 1,
          subtotal: 0,
        };
        const items = @json($items);
        const details = @json($details);

        return {
          // ingredients: @json($ingredients),
          rows: [ Object.assign({}, initialRow) ],
          total: 0,

          initSelect() {
            $('.selectdua').select2({
              theme: 'bootstrap4',
            });

            this.rows.forEach((row, index) => {
              $('.rowitem'+index).on('select2:select', e => {
                row.item_id = e.target.value;
                this.setDetail(row.item_id, index);
              });
              $('.rowvariant'+index).on('select2:select', e => {
                row.variant_id = e.target.value;
                this.setItemDetail(index);
              });
              $('.rowsize'+index).on('select2:select', e => {
                row.size_id = e.target.value;
                this.setItemDetail(index);
              });
              // $($(".selectdua").select2("container")).addClass("form-group");
            });
          },

          setDetail(id, index) {
            const item = items.find(item => item.id == id);
            let detail = item && details.filter(detail => detail.item_id == id);
            const nvariant = detail && detail.map(d => d.variant);
            const variant = nvariant && nvariant.filter((v,i,a)=>a.findIndex(t=>(t.id === v.id))===i)
            // const variantName = detail && new Set(detail.map(d => d.variant.name));
            // const size = detail && detail.map(d=>d.pluck('size'));
            const nsize = detail && detail.map(d => d.size);
            const size = nsize && nsize.filter((v,i,a)=>a.findIndex(t=>(t.id === v.id))===i);

            // this.itemdetails = detail;
            this.rows[index].variants = variant;

            // this.rows[index].variants.name = variantName;
            this.rows[index].sizes = size;

            this.setItemDetail(index);
          },

          setItemDetail(index) {
            const row = this.rows[index];
            const detail = details.filter(d => d.item_id == row.item_id && d.variant_id == row.variant_id && d.size_id == row.size_id);
            const detailId = detail && detail.map(d => d.id);
            const price = detail && detail.map(d => d.price);
            // const ingredient = detail[0] && detail[0].ingredients;

            row.detail = detailId;
            row.price = price;
            // row.ingredient = ingredient;
            this.setSubtotal(index);
            // console.log(row);
          },

          setSubtotal(index) {
            const row = this.rows[index];

            if (row.qty && row.price) {
              const subtotal = row.qty * row.price;
              row.subtotal = subtotal;

              this.setTotal();
            }
            // console.log(row.qty);

          },

          setTotal() {
            let result = 0;

            if (this.rows.length > 1) {
              result = this.rows.reduce((total, num) => (total + num.subtotal), 0);
            } else if (this.rows.length == 1) {
              result = this.rows[0].subtotal;
            }

            console.log(result);
            this.total = result;
          },

          addOrder() {
            this.rows.push(Object.assign({}, initialRow));
            // console.log(this.rows.length);
            this.$nextTick( () => { this.initSelect() });
          },

          removeOrder(index) {
            this.rows.splice(index, 1);
            this.setTotal();
          }

        };
      }
    </script>

@endsection
