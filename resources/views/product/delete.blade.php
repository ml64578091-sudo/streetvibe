<td class="text-center">

    <a href="{{ route('products.edit', $product->id) }}"
       class="btn btn-warning btn-sm">
        Edit
    </a>

    <form action="{{ route('products.destroy', $product->id) }}"
          method="POST"
          style="display:inline;">
        @csrf
        @method('DELETE')

        <button class="btn btn-danger btn-sm"
            onclick="return confirm('Yakin hapus produk ini?')">
            Delete
        </button>
    </form>

</td>
