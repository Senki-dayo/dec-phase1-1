<!-- resources/views/tweet/index.blade.php -->

<x-app-layout>
    <x-slot name="header">
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        {{ __('Blocklist') }}
      </h2>
    </x-slot>

    <div class="py-12">
      <div class="max-w-7xl mx-auto sm:w-10/12 md:w-8/10 lg:w-8/12">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
          <div class="p-6 bg-white border-b border-gray-200">
            <table class="text-center w-full border-collapse">
              <thead>
                <tr>
                  <th class="py-4 px-6 bg-grey-lightest font-bold uppercase text-lg text-grey-dark border-b border-grey-light">user</th>
                </tr>
              </thead>
              <tbody>
                @foreach ($users as $user)
                <tr class="hover:bg-grey-lighter">
                  <td class="py-4 px-6 border-b border-grey-light">
                    <div class="flex">

                      <img class="w-10 mr-2 rounded-lg" src="{{ asset('storage/'.$user->img_path) }}">

                      <!-- 名前の表示 -->
                      <a href="{{ route('follow.show', $user->id) }}">
                        <p class="text-left text-grey-dark">{{$user->name}}</p>
                      </a>

                      <!-- Block ボタン -->
                      @if($user->id !== Auth::id())
                        <!-- block 状態で条件分岐 -->
                        @if(Auth::user()->blockings()->where('users.id', $user->id)->exists())
                        <!-- unblock ボタン -->

                        <form action="{{ route('unblock', $user) }}" method="POST" class="text-left">
                            @csrf
                            <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-red py-1 px-2 focus:outline-none focus:shadow-outline">
                            <img class="h-6 w-6" src="{{ asset('images/caution_red.png') }}">
                            </button>

                        </form>
                        @else
                        <!-- block ボタン -->
                        <form action="{{ route('block', $user) }}" method="POST" class="text-left">
                            @csrf
                            <button type="submit" class="flex mr-2 ml-2 text-sm hover:bg-gray-200 hover:shadow-none text-black py-1 px-2 focus:outline-none focus:shadow-outline">
                            <img class="h-6 w-6" src="{{ asset('images/caution.png') }}">
                            </button>
                        </form>
                        @endif
                      @endif
                    </div>

                  </td>
                </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </x-app-layout>

